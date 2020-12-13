import React, { Component } from 'react';

class Counter extends Component {

    state = {
        count: 0
    }

    render(){
        return (
            <React.Fragment>
                <button onClick = { this.IncreaseCounter}> Click heree</button>
                <p> {this.state.count} </p>
            </React.Fragment>


        )

    }

    IncreaseCounter = () => {
        this.setState({
            count: this.state.count + 1
        })
    }

}

export default Counter;