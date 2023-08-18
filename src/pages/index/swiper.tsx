import React, { useRef, useState } from "react";
// Import Swiper React components
import { Swiper, SwiperSlide, useSwiper } from "swiper/react";

// Import Swiper styles
import "swiper/css";


export default function App() {
    const [navList, setNavList] = useState([true, false, false, false, false]);
    const SwiperButtonNext = ({ item, index }:any) => {
        const swiper = useSwiper();
        return <li
        className={`pagination__item ${item && 'pagination__item--active'
            }`}
        onClick={() => {
            swiper.slideTo(index);
            setNavList((data) => {
                let newData = data.map((item) => false);
                debugger;
                return newData.map((item, index2) => index == index2);
              });
        }}
    >
        <a className="pagination__button"></a>
    </li>;
    };
    return (
        <div style={{ padding: '0 110px' }}>

            <Swiper style={{ height: '500px' }}>
                <SwiperSlide >
                    <p className="swiper-no-swiping">Passive Market Making</p>
                    <p className="swiper-no-swiping">Hash Capital provides tight order book spreads execution capabilities through passive market making strategies.</p>
                </SwiperSlide>
                <SwiperSlide>
                    <p>Positive Market Making</p>
                    <p>Hash Capital provides volume-building execution capabilities through positive market making strategies.</p>
                </SwiperSlide>
                <SwiperSlide>
                    <p>Proprietary Trading</p>
                    <p>Hash Capital does not represent investors or customers in the management of any digital assets or fiat currencies.</p>
                </SwiperSlide>
                <SwiperSlide>
                    <p>High Frequency Trading</p>
                    <p>Hash Capital can consistently process large amounts of data in the shortest time with multiple strategies from multiple venues.</p>
                </SwiperSlide>
                <SwiperSlide>
                    <p>Building</p>
                    <p>Hash Capital is a passionate builder to foster the evolution, connection, and inspiration for blockchain and Web3.</p>
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
