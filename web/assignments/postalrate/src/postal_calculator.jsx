import React from 'react';
import ReactDOM from 'react-dom';
import WeightControl from './weight_control.jsx';
import TypeControl from './type_control.jsx';
import Toggle from './toggle.jsx';

export default function PostalCalculator(props) {
  return (
    <form
      className="border rounded p-4 mt-4"
      method="get"
      action="getRate"
      onSubmit={props.onSubmit}>
      <WeightControl
        weight={props.weight}
        onWeightChange={props.onWeightChange}
      />
      <TypeControl type={props.type} onTypeChange={props.onTypeChange} />
      <button type="submit" className="btn btn-primary mr-4 mb-4">
        Calculate
      </button>
      <Toggle
        onLabel="AJAX"
        offLabel="Old-school"
        handleToggleOn={props.onToggleOn}
        handleToggleOff={props.onToggleOff}
        toggled={props.useAjax}
      />
    </form>
  );
}
