import React, { useRef, useState } from "react";
// Import Swiper React components
import { Swiper, SwiperSlide, useSwiper } from "swiper/react";

// Import Swiper styles
import "swiper/css";
import './index.less';

export default function App() {
    const [swiper, setSwiper] = useState<any>();
    const [navList, setNavList] = useState([true, false, false, false, false]);
    const SwiperButtonNext = ({ item, index }: any) => {
        const swiper = useSwiper();
        return <li
            className={`pagination__item ${item && 'pagination__item--active'
                }`}
            onClick={() => {
                swiper.slideTo(index);
                setNavList((data) => {
                    let newData = data.map((item) => false);
                    return newData.map((item, index2) => index == index2);
                });
            }}
        >
            <a className="pagination__button"></a>
        </li>;
    };

    return (
        <div style={{ padding: '0 110px' }}>

            <Swiper style={{ height: '500px' }}
                onSwiper={(swiper) => setSwiper(swiper)}>
                <SwiperSlide>
                    <div className="s1">
                        <p className="swiper-no-swiping">Passive Market Making</p>
                        <p className="swiper-no-swiping">Hash Capital provides tight order book spreads execution capabilities through passive market making strategies.</p>
                        <img src="/1.jpg" />
                    </div>
                </SwiperSlide>
                <SwiperSlide>
                    <div className="s1">
                        <p>Positive Market Making</p>
                        <p>Hash Capital provides volume-building execution capabilities through positive market making strategies.</p>
                        <img src="/2.jpg" />
                    </div>
                </SwiperSlide>
                <SwiperSlide>
                    <div className="s1">
                        <p>Proprietary Trading</p>
                        <p>Hash Capital does not represent investors or customers in the management of any digital assets or fiat currencies.</p>
                        <img src="/3.jpg" />
                    </div>
                </SwiperSlide>
                <SwiperSlide>
                    <div className="s1">
                        <p>High Frequency Trading</p>
                        <p>Hash Capital can consistently process large amounts of data in the shortest time with multiple strategies from multiple venues.</p>
                        <img src="/4.jpg" />
                    </div>
                </SwiperSlide>
                <SwiperSlide>
                    <div className="s1">
                        <p>Building</p>
                        <p>Hash Capital is a passionate builder to foster the evolution, connection, and inspiration for blockchain and Web3.</p>
                        <img src="/5.jpg" />
                    </div>
                </SwiperSlide>
                <div style={{ position: 'absolute', bottom: 0, zIndex: 1 }}>

                    <ul className="pagination">
                        {navList.map((item, index) => (
                            <SwiperButtonNext key={index} item={item} index={index} />
                        ))}
                    </ul>

                </div>

            </Swiper>
        </div>
    );
}
