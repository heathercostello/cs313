import React from 'react';
import {Link} from 'react-router-dom';

export default function Result(props) {
  let {type, weight, rate} = props;
  return (
    <div className="card border rounded mt-4 p-4">
      <div className="card-body">
        <h5 className="card-title">Postal Rate</h5>
        <p>
          Your postal rate for <strong>{type}</strong> with weight{' '}
          <strong>{weight}</strong> oz. is:
        </p>
        <h1 className="display-4">{rate}</h1>
        <Link to="/" className="btn btn-primary">
          Calculate Another
        </Link>
      </div>
    </div>
  );
}
