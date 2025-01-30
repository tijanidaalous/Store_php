import React, { useEffect, useRef } from 'react'
import SearchIcon from '@mui/icons-material/Search'
import Notification from '@mui/icons-material/Notifications'
import Profile from '@mui/icons-material/Person'
import Dropdawn from '@mui/icons-material/ArrowDropDown'
import './Navbar.css'
import logo from '../../imgs/logo.jpg'
import { logout } from '../../../firebase'

const Navbar = () => {
const navref=useRef()
useEffect(()=>{
  window.addEventListener('scroll',()=>{
    if (navref.current) {
    if(window.scrollY>=80){
      navref.current.classList.add('nav-dark')
    }else{
      navref.current.classList.remove('nav-dark')

    }}
  })
},[])
  return (
    <div ref={navref} className='navbar'>
      <div className="navbar-left">
       <img  src={logo} alt="" />
       <ul>
        <li>Home</li>
        <li> TV Show </li>
        <li>Movies</li>
        <li>New & Popular</li>
        <li> MyList</li>
        <li>Browse by Languages</li>
       </ul>
      </div>
      <div className="navbar-right">
        <div className="icons"><SearchIcon></SearchIcon></div>     
        <p>Children</p>
        <div className="icons"><Notification></Notification></div>        
        <div className="navbar-profile">
        <div className="profile"><Profile></Profile></div>        
        <div className="dropdown">   
          <p onClick={()=>{logout()}}>Sing Out of Netflix</p>
        </div>
      </div>
      <div ><Dropdawn></Dropdawn></div>   
      </div>
    </div>
  )
}

export default Navbar
