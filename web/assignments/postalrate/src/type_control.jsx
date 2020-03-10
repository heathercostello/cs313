import React from 'react';
import ReactDOM from 'react-dom';

export default function TypeControl(props) {
  return (
    <div className="form-group">
      <label htmlFor="type">Item Type</label>
      <select
        id="type"
        className="form-control"
        name="type"
        value={props.type}
        onChange={props.onTypeChange}>
        <option value="stamped">Letters (Stamped)</option>
        <option value="metered">Letters (Metered)</option>
        <option value="flats">Large Envelopes (Flats)</option>
        <option value="parcels">Parcels</option>
      </select>
    </div>
  );
}
