import './App.css';
import { useState } from "react";
import axios from "axios";

function App() {

  const [login, setLogin] = useState('');
  const [password, setPassword] = useState('');

  const handleLogin = async () => {
    const backendURL = (window.location.hostname==="smkassist.com.br"?'https://smkassist.com.br/testes/backend/index.php':'http://testes/index.php');
    //const backendURL = ('http://testes/index.php');

    const response = await axios.post(backendURL, {
      action: 'teste',
    });

    console.log('post');
    console.log(response.data);

    // const response2 = await axios.get(backendURL, {
    //   action: 'teste',
    // });

    // console.log('get');
    // console.log(response2.data);
  };

  
  return (
    <div className="App">
      <button onClick={handleLogin}>TESTE</button>
    </div>
  );
}

export default App;