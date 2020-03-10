import React from 'react';
import styled from 'styled-components';

const Label = function(props) {
  return (
    <small className={`text-primary ${props.className}`}>
      {props.children}
    </small>
  );
};
const ToggleLabel = styled(Label)`
  margin: 5px;
`;

const ToggleButton = styled.button.attrs({
  type: 'button',
})`
  height: 20px;
  width: 20px;
  border-radius: 10px;
  position: relative;
  left: ${props => (props.toggled ? '30px' : '0')};
`;

const Slide = function(props) {
  return (
    <div
      className={
        (props.toggled ? 'bg-success' : 'bg-secondary') + ' ' + props.className
      }>
      <ToggleButton toggled={props.toggled} onClick={props.handleToggle} />
    </div>
  );
};
const ToggleSlide = styled(Slide)`
  display: inline-block;
  width: 50px;
  height: 20px;
  border-radius: 10px;
  vertical-align: middle;
`;

const Panel = function(props) {
  return (
    <div>
      <ToggleLabel>{props.offLabel}</ToggleLabel>
      <ToggleSlide toggled={props.toggled} handleToggle={props.handleToggle} />
      <ToggleLabel>{props.onLabel}</ToggleLabel>
    </div>
  );
};
const TogglePanel = styled(Panel)`
  display: inline-block;
`;

export default class Toggle extends React.Component {
  constructor(props) {
    super(props);
    this.state = {toggled: this.props.toggled || false};
    this.handleToggle = this.handleToggle.bind(this);
  }

  handleToggle(event) {
    let newState = !this.state.toggled;
    this.setState({toggled: newState});
    if (newState) {
      if (this.props.handleToggleOn) this.props.handleToggleOn(event);
    } else {
      if (this.props.handleToggleOff) this.props.handleToggleOff(event);
    }
  }

  render() {
    return (
      <TogglePanel
        toggled={this.state.toggled}
        handleToggle={this.handleToggle}
        offLabel={this.props.offLabel || 'Off'}
        onLabel={this.props.onLabel || 'On'}
      />
    );
  }
}
