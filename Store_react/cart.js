import "../stylee/shoppinglist.css";
import { useState, useEffect } from 'react';

function Carte({ list: initialList }) {
  // Initialize state with the list from props
  const [list, setList] = useState([]);

  // Set the initial state when the component mounts
  useEffect(() => {
    setList(initialList);
  }, [initialList]);

  // Handle item deletion
  const handleDelete = (description) => {
    const updatedList = list.filter(item => item.description !== description);
    setList(updatedList);
  };

  return (
    <div className='cart'>
      <h1>Produits</h1>
      <ul>
        {list.map((item, index) => (
          <li key={index}>
            {item.description} - {item.prix} €
            <button onClick={() => handleDelete(item.description)}>
              delete
            </button>
          </li>
        ))}
      </ul>

      <h2>Total price: {list.reduce((total, item) => total + item.prix, 0)} €</h2>
    </div>
  );
}

export default Carte;
