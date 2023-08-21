import React, { useRef, useState } from "react";
// Import Swiper React components
import { Swiper, SwiperSlide, useSwiper } from "swiper/react";

// Import Swiper styles
import "swiper/css";
import './index.less';

export default function App() {
	const [swiper, setSwiper] = useState<any>();
	const [navList, setNavList] = useState([{
		flag: true,
		value: 'Making'
	}, {
		flag: false,
		value: 'Trading'
	}, {
		flag: false,
		value: 'Building'
	}, {
		flag: false,
		value: 'Thinking'
	}]);
	const SwiperButtonNext = ({ item, index, children }: any) => {
		// const swiper = useSwiper();
		return <div
			className={`btn ${item.flag && 'btn_active'}`}
			onClick={() => {
				swiper.slideTo(index);
				setNavList((data) => {
					let newData = data.map((item) => { item.flag = false; return item; });
					return newData.map((item2, index2) => { item2.flag = (index == index2); return item2; });
				});
			}}
		>
			{children}
		</div>;
	};

	return (
		<>
			<div className="card">

				<div style={{ display: 'flex', gap: '10px' }}>
					{navList.map((item, index) => (
						<SwiperButtonNext key={index} item={item} index={index}>
							{item.value}
						</SwiperButtonNext>
					))}
				</div>

			</div>
			<div style={{ padding: '0 110px' }}>

				<Swiper style={{ height: '500px' }}
					onSwiper={(swiper) => setSwiper(swiper)}>
					<SwiperSlide>
						<div className="s1 flex">
							<div className="f1 flex flex-a-i-c">
								<div>
									<h1 className="swiper-no-swiping">Passive Market Making</h1>
									<p className="swiper-no-swiping">Hash Capital provides tight order book spreads execution capabilities through passive market making strategies.</p>
									<p className="swiper-no-swiping">Hash Capital provides volume-building execution capabilities through positive market making strategies.</p>
								</div>
							</div>
							<div className="f1">
								<img src="/1.jpg" />
							</div>
						</div>
					</SwiperSlide>
					<SwiperSlide>
						<div className="s1 flex">
							<div className="f1 flex flex-a-i-c">
								<div>
									<h1 className="swiper-no-swiping">Proprietary Trading</h1>
									<p className="swiper-no-swiping">Hash Capital does not represent investors or customers in the management of any digital assets or fiat currencies.</p>
								</div>
							</div>
							<div className="f1">
								<img src="/2.jpg" />
							</div>
						</div>
					</SwiperSlide>
					<SwiperSlide>
						<div className="s1 flex">
							<div className="f1 flex flex-a-i-c">
								<div>
									<h1 className="swiper-no-swiping">High Frequency Trading</h1>
									<p className="swiper-no-swiping">Hash Capital can consistently process large amounts of data in the shortest time with multiple strategies from multiple venues.</p>
								</div>
							</div>
							<div className="f1">
								<img src="/3.jpg" />
							</div>
						</div>
					</SwiperSlide>
					<SwiperSlide>
						<div className="s1 flex">
							<div className="f1 flex flex-a-i-c">
								<div>
									<h1 className="swiper-no-swiping">Building</h1>
									<p className="swiper-no-swiping">Hash Capital is a passionate builder to foster the evolution, connection, and inspiration for blockchain and Web3.</p>
								</div>
							</div>
							<div className="f1">
								<img src="/4.jpg" />
							</div>
						</div>
					</SwiperSlide>
				</Swiper>
			</div>
		</>

	);
}
