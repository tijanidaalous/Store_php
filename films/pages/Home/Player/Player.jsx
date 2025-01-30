import React, { useEffect, useState } from 'react'
import './Player.css'
import ArrowBackIcon from '@mui/icons-material/ArrowBack'
import { useNavigate, useParams } from 'react-router-dom'
const Player = () => {

  const {id}=useParams()
 const navigate =useNavigate()

  const [apidata,setapidata]=useState({
    name:"",
    key:'',
    published_at:'',
    type:''
  })
  const options = {
    method: 'GET',
    headers: {
      accept: 'application/json',
      Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJkMTI2ODhhYzllNzM2MTAzZjViNTllMTU2OWMyYWUyZSIsIm5iZiI6MTczMzc0MDc0MS4xNCwic3ViIjoiNjc1NmM4YzU2ZTBiZWQyNjZiN2ZhODc3Iiwic2NvcGVzIjpbImFwaV9yZWFkIl0sInZlcnNpb24iOjF9.ek4JhVyl7GPt5MExNtBSCyUSuQJHFMwEHfKOQUA7670'
    }
  };
  useEffect(()=>{
    fetch(`https://api.themoviedb.org/3/movie/${id}/videos?language=en-US`, options)
    .then(res => res.json())
    .then(res => setapidata(res.results[0]))
    .catch(err => console.error(err));
  },[])
  

  return (
    <div className='player'>
      <div className='icon' onClick={()=>{navigate(-2)}}> <ArrowBackIcon></ArrowBackIcon></div>
      <iframe width="90%" height='90%' src={`https://www.youtube.com/embed/${apidata.key}` }
      titile='trailer' frameborder="0" allowFullScreen></iframe>
      <div className="player-info">
        <p>{apidata.published_at.slice(0,10)}</p>
        <p>{apidata.name}</p>
        <p>{apidata.type}</p>
      </div>
      
    </div>
  )
}

export default Player
