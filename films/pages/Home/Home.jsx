import React from 'react';
import './Home.css';
import Play_icon from '@mui/icons-material/PlayArrow'
import Info_icon from '@mui/icons-material/Info'
import Navbar from '../../components/Navbar/Navbar';
import hero_title from '../../imgs/protector2.PNG';
// import play_icon from '../../imgs/play.jpeg';
// import info_icon from '../../imgs/info.jpeg'
import TitileCards from '../../components/Navbar/TitileCards/TitileCards';
import Footer from '../../components/Navbar/Footer/Footer';
const Home = () => {
  return (
    <div className='home'>
      <Navbar />

      <div className="hero">
        <img src={hero_title} alt="Hero Banner" className='banner_img' />
        <div className="hero_caption">
            <h1>The Protector</h1>
            <p>Discovering his ties to a secret ancient order, a young man embarks on an epic journey.</p>
             <div className="hero-btns">
              <button className='btn'><Play_icon></Play_icon> Play</button>
              <button className='btn dark-btn'>< Info_icon></Info_icon>More Info</button>
             </div>
             <div className="titile-cards">
             <TitileCards></TitileCards>    
             </div>

              
         </div>
      </div>
      <div className="more-cards">
      <TitileCards titile={'Blockbuster Movies'} category={"top_rated"}></TitileCards>
      <TitileCards titile={'Only on Netflex '} category={'popular'} ></TitileCards>
      <TitileCards titile={'Upcoming '} category={'upcoming'}></TitileCards>
      <TitileCards titile={'Top Pics for You'} category={'now_playing'}></TitileCards>
      </div>
      <Footer></Footer>
    </div>
  );
};

export default Home;
