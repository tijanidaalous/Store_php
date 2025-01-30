import React, { useState } from 'react';

export default function Quantiter({ onsenddata }) {
  const [qunti, setQunti] = useState('');

  function handleChange(e) {
    const value = e.target.value;
    setQunti(value);
    onsenddata(value); // Send data to parent component
  }

  return (
    <input
      onChange={handleChange}
      value={qunti}
      style={{ margin: '5px', width: '60px' }}
      type="number"
      min="0"
      placeholder="0"
    />
  );
}
