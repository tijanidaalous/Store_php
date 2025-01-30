import React, { useEffect, useRef, useState } from 'react'
import './TitileCards.css'
// import cards_data from '../../../asserts/cards_data'
import { Link } from 'react-router-dom'


const TitileCards = ({titile,category}) => {
  const [apidata,setapidata]=useState([])
  const cardsRef =useRef();
  const options = {
    method: 'GET',
    headers: {
      accept: 'application/json',
      Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJkMTI2ODhhYzllNzM2MTAzZjViNTllMTU2OWMyYWUyZSIsIm5iZiI6MTczMzc0MDc0MS4xNCwic3ViIjoiNjc1NmM4YzU2ZTBiZWQyNjZiN2ZhODc3Iiwic2NvcGVzIjpbImFwaV9yZWFkIl0sInZlcnNpb24iOjF9.ek4JhVyl7GPt5MExNtBSCyUSuQJHFMwEHfKOQUA7670'
    }
  };
  
  fetch('https://api.themoviedb.org/3/movie/now_playing?language=en-US&page=1', options)
    .then(res => res.json())
    .then(res => console.log(res))
    .catch(err => console.error(err));
const handleWheel=(event)=>{
  event.preventDefault();
  cardsRef.current.scrollLeft += event.deltaY
}
useEffect(()=>{

  const options = {
    method: 'GET',
    headers: {
      accept: 'application/json',
      Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJkMTI2ODhhYzllNzM2MTAzZjViNTllMTU2OWMyYWUyZSIsIm5iZiI6MTczMzc0MDc0MS4xNCwic3ViIjoiNjc1NmM4YzU2ZTBiZWQyNjZiN2ZhODc3Iiwic2NvcGVzIjpbImFwaV9yZWFkIl0sInZlcnNpb24iOjF9.ek4JhVyl7GPt5MExNtBSCyUSuQJHFMwEHfKOQUA7670'
    }
  };
  
  fetch(`https://api.themoviedb.org/3/movie/${category?
    category:'now_playing'}?language=en-US&page=1` , options)
    .then(res => res.json())
    .then(res => setapidata(res.results))
    .catch(err => console.error(err));


  cardsRef.current.addEventListener('Wheel',handleWheel)
},[])
  return (
  
    <div className='titileCards'>
      <h2>{titile?titile:'Popular on Netflix'} </h2>
      <div className="card-list" ref={cardsRef}>
      {apidata.map((card,index)=>{
return <Link to={`/player/${card.id}`} className="card" key={index}>
           <img src={`https://image.tmdb.org/t/p/w500`+ card.backdrop_path} alt="" />
           <p>{card.original_title}</p>
           
       </Link>
      })}
      </div>
     
    </div>
   
  )
}

export default TitileCards
