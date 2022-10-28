import logo from './logo.svg';
import './App.css';

import React, { useEffect , useState } from 'react';
import axios from 'axios';
const url = 'http://10.10.10.244:8000/api/productos'
function App() {
	
		  const [data, setData] = useState([]);

const peticion=async()=>{
await axios.get(url)
.then(response=>{
    console.log(response.data);
})
}


useEffect (async () => {
     await peticion();

  },[]);

	

  return (
    <div className="App">
      <header className="App-header">
        <img src={logo} className="App-logo" alt="logo" />
        <p>
          Edit <code>src/App.js</code> and save to reload.
        </p>
        <a
          className="App-link"
          href="https://reactjs.org"
          target="_blank"
          rel="noopener noreferrer"
        >
          Learn React
        </a>
      </header>
    </div>
  );
}

export default App;
