import React from 'react';
import ReactDOM from 'react-dom';
import {withRouter} from 'react-router';
import {BrowserRouter as Router, Route} from 'react-router-dom';
import Result from './result.jsx';
import PostalCalculator from './postal_calculator.jsx';
import CalculationError from './error.jsx';

class App extends React.Component {
  constructor(props) {
    super(props);
    this.handleWeightChange = this.handleWeightChange.bind(this);
    this.handleTypeChange = this.handleTypeChange.bind(this);
    this.useAjaxStrategy = this.useAjaxStrategy.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleToggleOff = this.handleToggleOff.bind(this);
    this.handleToggleOn = this.handleToggleOn.bind(this);
    this.state = {weight: 0.02, type: 'stamped', rate: 0, useAjax: false};
  }

  handleWeightChange(event) {
    this.setState({weight: event.target.value});
  }

  handleTypeChange(event) {
    this.setState({type: event.target.value});
  }

  useDefaultStrategy(event) {
    console.log('submitting using default approach...');
    return;
  }

  useAjaxStrategy(event) {
    console.log('submitting using AJAX...');
    event.preventDefault();
    let url = `/api/rates/${this.state.type}?weight=${this.state.weight}`;
    fetch(url, {method: 'GET'})
      .then(res => {
        if (res.ok && res.status == 200) return res.json();

        throw res;
      })
      .then(data => {
        let {rate} = data;
        this.setState({rate: rate});
        this.props.history.push('/result');
      })
      .catch(err => {
        err.text().then(msg => {
          this.props.history.push('/error', {message: msg});
        });
      });
  }

  handleSubmit(event) {
    if (this.state.useAjax) this.useAjaxStrategy(event);
    else this.useDefaultStrategy(event);
  }

  handleToggleOn() {
    this.setState({useAjax: true});
  }

  handleToggleOff() {
    this.setState({useAjax: false});
  }

  render() {
    return (
      <div className="col-sm-4">
        <Route
          exact
          path="/"
          render={() => (
            <PostalCalculator
              weight={this.state.weight}
              type={this.state.type}
              useAjax={this.state.useAjax}
              onWeightChange={this.handleWeightChange}
              onTypeChange={this.handleTypeChange}
              onToggleOn={this.handleToggleOn}
              onToggleOff={this.handleToggleOff}
              onSubmit={this.handleSubmit}
            />
          )}
        />
        <Route
          path="/result"
          render={() => (
            <Result
              weight={this.state.weight}
              type={this.state.type}
              rate={this.state.rate}
            />
          )}
        />
        <Route path="/error" component={withRouter(CalculationError)} />
      </div>
    );
  }
}

const MyApp = withRouter(App);

ReactDOM.render(
  <Router>
    <MyApp />
  </Router>,
  document.getElementById('app'),
);
