import React from 'react';

export default function WeightControl(props) {
  return (
    <div className="form-group">
      <label htmlFor="weight">Item Weight (oz.)</label>
      <input
        type="number"
        min="0.01"
        step="0.01"
        id="weight"
        className="form-control"
        placeholder="0.01"
        name="weight"
        value={props.weight}
        onChange={props.onWeightChange}
      />
    </div>
  );
}
