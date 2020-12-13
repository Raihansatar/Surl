import React, { Component } from "react";

import {
    Route,
    NavLink,
    HashRouter
} from "react-router-dom";

import Home from "./Page/Home";
import Stuff from "./Page/Stuff";
import Contact from "./Page/Contact";

class Main extends Component {
    render() {
      return (
        <HashRouter>
          <div>
            <h1>Simple SPA</h1>
            <ul className="header">
                <li><NavLink exact to="/">Home</NavLink></li>
                <li><NavLink to="/stuff">Stuff</NavLink></li>
                <li><NavLink to="/contact">Contact</NavLink></li>
            </ul>

            <button className="btn btn-info"> button</button>
            
            <div className="content">
                <Route exact path="/" component={Home}/>
                <Route path="/stuff" component={Stuff}/>
                <Route path="/contact" />
            </div>
          </div>
        </HashRouter>
      );
    }
  }

export default Main;