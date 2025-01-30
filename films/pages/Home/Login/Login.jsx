import React, { useState } from 'react'
import './Login.css'
import logo from '../../../imgs/logo.jpg'
import {login , signup} from '../../../../firebase'
import netflex_spinner from '../../../imgs/netflex_spinner.gif'


const Login = () => {
  const [signstate,setsignstate]=useState('Sign In')

  const [name,setname]=useState('')
  const [email,setemail]=useState('')
  const [password,setpassword]=useState('')
  const [loading,setloading]=useState(false)
  const user_auth= async(event)=>{
    event.preventDefault()
    setloading(true)
    if(signstate==='Sign In'){
      await login(email,password)
    }else{
      await signup(name , email, password)
    }
    setloading(false)
  }



  return (
    loading?<div className="login_spinner">
      <img src={netflex_spinner} alt="" />
    </div>:
    <div className='login'>
      <img src={logo} alt=""  className='login-logo'/>
      <div className="login-form">
      <h1>{signstate}</h1>
      <form >
        {signstate==='Sign Up'?
        <input value={name} onChange={(e)=>{setname(e.target.value)}}
         type='text' placeholder='Your name'/>:
        <></>}

        <input value={email} onChange={(e)=>{setemail(e.target.value)}}
         type="email" placeholder='Email' />
        <input value={password} onChange={(e)=>{setpassword(e.target.value)}}
         type="password" placeholder='Password' />
      <button onClick={user_auth} type='submit'>{signstate}</button>
      <div className="form-help">
        <div className="remember">
        <input type="checkbox" />
        <label htmlFor="">Remember Me</label>
        </div>
        <p>Need Help</p>
      </div>
      </form>
      <div className="form-switch">
        {signstate==='Sign In'? <p>New to Netflix? <span onClick={()=>setsignstate('Sign Up')}>Sign Up Now</span></p>
        :<p>Already have account?  <span onClick={()=>setsignstate('Sign In')}>Sign In Now</span></p>}
       

      </div>
      </div>
    </div>
  )
}

export default Login
