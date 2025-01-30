import { useState } from "react";
import Shoppinglist from "./shoppinglist";
import Banner from "./Banner";
function Categories(){
let [categori,setcaetgori]=useState('phone')
 return(
    <>
   <Banner></Banner>
  <div style={{marginLeft:'500px',width:'400px',padding:'10px',textAlign:'center',margin:'0px',border:'solid 2px black'}}>
 <label for="choix">Choisissez un appareil :</label>
<select onChange={(e)=>setcaetgori(e.target.value)} id="choix" name="choix">
    <option value="phone">phone</option>
    <option value="tv">Télévision</option>
    <option value="ordinateur">ordinateur</option>
</select>


   <button>choiser</button>
  </div>
  <Shoppinglist categori={categori}></Shoppinglist>
  </>
 )
}
export default Categories;