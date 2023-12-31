const tailwind = require('./tailwind.config');
const semver = require('semver');
const requiredNodeVersion = require('./package').engines.node;

if (!semver.satisfies(process.version, requiredNodeVersion)) {
	console.log(
		`Please switch to node version ${requiredNodeVersion} to build. You're currently on ${process.version}. Use FNM or NVM to manage node versions and auto switching.`,
	);
	process.exit(1);
}

module.exports = ({ mode, file }) => ({
	ident: 'postcss',
	sourceMap: mode !== 'production',
	plugins: [
		require('postcss-import'),
		require('tailwindcss/nesting'),
		require('tailwindcss')({
			...tailwind,
			// Scope the editor css separately from the frontend css.
			content: findContent(file),
			important: findImportant(file),
		}),
		(css) =>
			css.walkRules((rule) => {
				// Removes top level TW styles like *::before {}
				rule.selector.startsWith('*') && rule.remove();
			}),
		// See: https://github.com/WordPress/gutenberg/blob/trunk/packages/postcss-plugins-preset/lib/index.js
		require('autoprefixer')({ grid: true }),
		mode === 'production' &&
			// See: https://github.com/WordPress/gutenberg/blob/trunk/packages/scripts/config/webpack.config.js#L68
			require('cssnano')({
				preset: [
					'default',
					{
						discardComments: {
							removeAll: true,
						},
					},
				],
			}),
		require('postcss-safe-important'),
	],
});

const findContent = (file) => {
	console.log(`Processing: ${file}`);
	if (file.endsWith('/Library/library.css')) {
		return ['./src/Library/**/*.{js,jsx}'];
	}
	if (file.endsWith('/Launch/launch.css')) {
		return ['./src/Launch/**/*.{js,jsx}'];
	}
	if (
		file.endsWith('/Assist/app.css') ||
		file.endsWith('/Assist/documentation.css')
	) {
		return ['./src/Assist/**/*.{js,jsx}'];
	}
	if (file.endsWith('/Chat/app.css')) {
		return ['./src/Chat/**/*.{js,jsx}'];
	}
	if (file.endsWith('/Draft/app.css')) {
		return ['./src/Draft/**/*.{js,jsx}'];
	}
	return [];
};

const findImportant = (rawFile) => {
	const file = rawFile.toLowerCase();
	let tailwindPrefix = true;

	const filePrefixes = {
		library: 'div.extendify-library',
		launch: 'div.extendify-launch',
		assist: '.extendify-assist',
		chat: '.extendify-chat',
		draft: '.extendify-draft',
	};

	Object.keys(filePrefixes).forEach((key) => {
		if (file.includes(key)) {
			tailwindPrefix = filePrefixes[key];
		}
	});

	return tailwindPrefix;
};
