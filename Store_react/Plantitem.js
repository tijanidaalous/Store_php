import React, { useState } from 'react';
import "../stylee/shoppinglist.css";
import Quantiter from './quantiter';
import Carte from './cart'

function Plantitem(props) {
  const [lest, setList] = useState([]);
  const [currentQuantity, setCurrentQuantity] = useState(0);

  function datafromchild(qunti) {
    setCurrentQuantity(qunti);
  }

  function ajouter(Element) {
    const calculatedPrice = Element.prix * currentQuantity;

    // Check if the item already exists in the list
    const existingItem = lest.find(item => item.description === Element.describtion);

    if (!existingItem) {
      // Add a new item if it doesn't exist
      setList(prevList => [
        ...prevList,
        { description: Element.describtion, prix: calculatedPrice }
      ]);
    } else {
      // Update the price of the existing item
      const updatedList = lest.map(item => {
        if (item.description === Element.describtion) {
          return {
            ...item,
            prix: item.prix + calculatedPrice
          };
        }
        return item; // Return the original item if it doesn't match
      });

      setList(updatedList);
    }
  }

  return (
    <>
      <Carte list={lest}></Carte>
    <div className="dev1">
      {props.produits.filter(ele=>ele.categori==props.categori) 
      .map((Element, index) => (
        <div key={Element.id}>
          <img src={Element.src} alt={Element.describtion} width={100} height={100} />
          <p>{Element.describtion}</p>
          <Quantiter onsenddata={datafromchild} />
          <p>Prix unitaire: {Element.prix}</p>
          <button onClick={() => ajouter(Element)}>
            Ajouter au panier
          </button>
    </div>
      ))}
 </div>
   
    </>
  );
}

export default Plantitem;
