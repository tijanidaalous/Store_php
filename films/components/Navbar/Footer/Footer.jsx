import React from 'react'
import './Footer.css'
import youtube_icon from '../../../imgs/youtube.jpeg'
import twiter_icon from '../../../imgs/twiter.jpeg'
import instagram_icon from '../../../imgs/instagram.jpeg'
import facebook_icon from '../../../imgs/face1.jpeg'
const Footer = () => {
  return (
    <div className='footer'>
      <div className="Footer-icon">
        <img src={youtube_icon} alt="" />
        <img src={twiter_icon} alt="" />
        <img src={instagram_icon} alt="" />
        <img src={facebook_icon} alt="" />
      </div>
      <ul>
        <li>Audio Description</li> 
        <li>Help center</li>
         <li>Gift Cards</li> 
        <li>Media Center</li>
        <li>Investor Relation</li>
        <li>Jobs</li>
        <li>Terms of Use</li>
        <li>Privacy</li>
        <li>Legal Notices</li>
        <li>Cookie Preferences</li>
        <li>Corporate Information</li>
        <li>Contact us</li>
      </ul>
      <p className='copyright-taxt'>1997-2023 Netflix, Inc</p>
    </div>
  )
}

export default Footer
