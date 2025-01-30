function Prix() {
  const produit = [{ id: 1, prix: 100 }];

  const foundProduct = produit.find(element => element.id === 1);

  return (
    <p>
      {foundProduct ? foundProduct.prix : 'Produit non trouvé'}
    </p>
  );
}

export default Prix;
