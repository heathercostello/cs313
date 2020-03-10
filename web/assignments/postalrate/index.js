const express = require('express');
const app = express();
const PORT = process.env.PORT || 5000;
const CALC_FUNC = {
  stamped: calculateStamped,
  metered: calculateMetered,
  flats: calculateFlats,
  parcels: calculateParcel,
};

app.use(express.static('public'));
app.set('view engine', 'ejs');
app.get('/getRate', (req, res) => {
  let {weight, type} = req.query;
  try {
    res.render('result', {
      weight: weight,
      type: type,
      rate: calculateRate(+weight, type).toLocaleString('en-US', {
        style: 'currency',
        currency: 'USD',
      }),
    });
  } catch (err) {
    console.log({error: err, weight: weight, type: type});
    res.render('error', {message: err.message});
  }
});

app.get('/api/rates/:type/', (req, res) => {
  let {weight} = req.query;
  let {type} = req.params;
  try {
    let rate = calculateRate(+weight, type).toLocaleString('en-US', {
      style: 'currency',
      currency: 'USD',
    });
    res.json({type: type, weight: +weight, rate: rate});
  } catch (err) {
    console.log({error: err, weight: weight, type: type});
    res.status(400).send(err.message);
  }
});

app.listen(PORT, () => console.log(`Listening on port ${PORT}`));

function calculateRate(weight, type) {
  if (weight <= 0) throw new Error('You must provide a weight greater than 0');
  return CALC_FUNC[type](weight);
}

function calculateMetered(weight) {
  return calculateIncremental(weight, 3.5, 0.47, 0.21);
}

function calculateStamped(weight) {
  return calculateIncremental(weight, 3.5, 0.5, 0.21);
}

function calculateFlats(weight) {
  return calculateIncremental(weight, 13, 1.0, 0.21);
}

function calculateParcel(weight) {
  const FIRST_BREAK = 4;
  const SECOND_BREAK = 8;
  const UPPER_LIMIT = 13;
  if (weight >= UPPER_LIMIT)
    throw new Error(`Weight is too high. Must be less than ${UPPER_LIMIT}`);
  if (weight < FIRST_BREAK) return 3.5;
  if (weight < SECOND_BREAK) return 3.75;
  return calculateIncremental(
    weight - SECOND_BREAK,
    UPPER_LIMIT - SECOND_BREAK,
    4.1,
    0.35,
  );
}

function calculateIncremental(weight, upper_limit, base_rate, incr) {
  const UPPER_LIMIT = upper_limit;
  if (weight >= UPPER_LIMIT)
    throw new Error(`Weight is too high. Must be less than ${UPPER_LIMIT}`);

  const BASE_RATE = base_rate;
  const INCR = incr;
  let result = 0.0;
  let breakWeight = Math.trunc(weight);
  return BASE_RATE + breakWeight * INCR;
}
