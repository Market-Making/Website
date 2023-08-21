import './index.less';
import Swiper from "./swiper";
export default function HomePage() {
  return (
    <div>
      <div style={{ padding: '30px 80px' }}>
        <img width={110} src="/logo.svg" />
      </div>
      {/*  */}
      <div className='flex sol'>
        <div className='f1'>
          <div className='left flex flex-d-c flex-j-c-c'>
            <p className='title' style={{ fontFamily: 'FugazOne' }}>Hash Capital</p>
            <p>Hash Capital is a leading market marker, algorithmic trader, and proprietary player in digital assets.
            </p>
            <p>
              We create liquidity and efficient markets on both centralized and decentralized trading platforms. We build long-term relationships by delivering sustainable liquidity solutions for our clients.</p>
          </div>

        </div>
        <div className='f1'>
          <iframe src="/plan4/index.html"></iframe>
        </div>
      </div>
      <Swiper />
      <div className='flex flex-j-c-f-e us' style={{ margin: '0 110px', marginTop: '30px', gap: '40px', padding: '30px' }}>
        <div>
          <h4>
            JOIN US
          </h4>
          <div>
            FOLLOW US
            <br />
            Twitter
            <br />

            Linkedin
            <br />

            Contact Us
          </div>
        </div>

        <div>
          <h4>
            CREATE LIQUID MARKETS
          </h4>
          <div>
            WINTERMUTE VENTURES <br />
            Contact us
          </div>
        </div>
      </div>
      <div style={{ padding: '0 110px',marginTop:'30px' }}>

        <div className='flex flex-j-c-s-b'>
          <span>©2023 BY WINTERMUTE TRADING LTD</span>
        </div>
      </div>
      <div className=' us' style={{ margin: '30px 110px', gap: '40px', padding: '30px' }}>
        <p>
          Hash Capital is a proprietary player that provides liquidity on various crypto assets. Hash Capital does not represent investors in the management of any encrypted assets or fiat currencies, nor does it represent investors or customers holding fiat currencies or encrypted assets. Hash Capital is not authorized or regulated by any regulatory authority, which means that any party transacting with Hash Capital may not benefit from the protections normally afforded when dealing with regulated entities, such as any compensation or ombudsman schemes.
          <br />
          The material on Hash Capital’s website is provided for informational purposes only and does not constitute an offer or solicitation to buy any crypto asset or any form of financial instrument that references a crypto asset. The information on our website is not directed at or intended for distribution to or use by any person resident in any country or jurisdiction where such distribution or use would be contrary to local law or regulation. Any reference to "market maker" or "market maker" in content posted on our website or in connection with our activities is a reference to the broader provision of liquidity and not to references that may be made by securities A Regulated Activity referred to by the Trading Commission or other regulatory or self-regulatory organization using the same or a similar designation.
          <br />

          The financial products detailed in this document are not intended for, and are not available to, persons or entities organized in any prohibited jurisdiction. Nothing in this document should be construed as constitute an offer to sell, an invitation to buy, distribute or recommend the financial products detailed in this document to any person or entity in a prohibited jurisdiction. Virtual assets and their derivatives must not be traded on regulated exchanges or operate under a generally accepted and transparent set of rules. Therefore, you may not be eligible for the same level of the rights and protections you would normally enjoy when investing in products on a regulated exchange. Fraud and market misconduct in virtual assets is not uncommon, which increases the risk of loss. Hash Capital makes no warranties (whether express or implied) or makes any representations that the contents of this document are reliable and accurate and complete.

        </p>
      </div>
      <div>

      </div>
    </div>
  );
}
