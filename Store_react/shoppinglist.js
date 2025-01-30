import Plantitem from "./Plantitem";
import img1 from '../img/ihpone1.jpeg'
import img2 from '../img/ord1.jpeg'
import img3 from '../img/tv1.jpeg'
import img4 from '../img/phone2.jpeg'
import "../stylee/shoppinglist.css";
function Shoppinglist(props){
 const  produits=[ 
      {src:img1,describtion:'phone',prix:100,categori:'phone'},
      {src:img2,describtion:'ordinateur',prix:200,categori:'ordinateur'},
      {src:img3,describtion:'tv',prix:300,categori:'tv'},
      {src:img4,describtion:'phone1',prix:400,categori:'phone'},
      {src:img4,describtion:'phone1',prix:400,categori:'phone'},
      {src:img4,describtion:'phone1',prix:400,categori:'phone'},
      ]
 return(
  <div  className="shopinglist">
   <Plantitem produits ={produits} categori={props.categori}></Plantitem>
  
</div>
   
  
 )
}
export default Shoppinglist;