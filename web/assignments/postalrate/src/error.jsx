import React from 'react';
import {Link} from 'react-router-dom';

export default function CalculationError(props) {
  let {message} = props.location.state;
  return (
    <div className="card border rounded mt-4 p-4">
      <div className="card-body">
        <h5 className="card-title text-danger">Error</h5>
        <p className="card-text">{message}</p>
        <Link to="/" className="btn btn-primary">
          Go Back
        </Link>
      </div>
    </div>
  );
}
