import yayJpg from '../assets/yay.jpg';

export default function HomePage() {
  return (
    <div>
      <div style={{ margin: '30px' }}>
        <img width={110} src="/logo.svg" />
      </div>
      {/*  */}
      <div>
        <div>
          <p>Hash Capital</p>
          <p>Hash Capital is a leading market marker, algorithmic trader, and proprietary player in digital assets.
          </p>
          <p>
            We create liquidity and efficient markets on both centralized and decentralized trading platforms. We build long-term relationships by delivering sustainable liquidity solutions for our clients.</p>
        </div>
        <div>
          <iframe src="/plan4/index.html"></iframe>
        </div>
      </div>
    </div>
  );
}
