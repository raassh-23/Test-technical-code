import { useState } from "react";
import useFetch from "./customHooks/useFetch";

const baseUrl = "http://localhost:8000";

function getUrl(path, query) {
  const url = new URL(path, baseUrl);

  for (const key in query) {
    url.searchParams.set(key, query[key]);
  }

  return url;
}

function App() {
  const [input, setInput] = useState("");
  const [url, setUrl] = useState(null);
  const { data, error, loading } = useFetch(url);

  return (
    <div className="App">
      <input className="text-input" value={input} onChange={(e) => setInput(e.target.value)} placeholder="Input angka" />
      <div className="btn-group">
        <button className="btn" onClick={() => setUrl(getUrl("/segitiga", { input }))}>Generate Segitiga</button>
        <button className="btn" onClick={() => setUrl(getUrl("/ganjil", { input }))}>Generate Bilangan Ganjil</button>
        <button className="btn" onClick={() => setUrl(getUrl("/prima", { input }))}>Generate Bilangan Prima</button>
      </div>
      <div className="result">
        <h1>Result:</h1>
        {loading ? <p>Loading...</p> :
          error ? <p>Error: {error.message}</p> :
            data && Array.isArray(data) && data.map((item) => <p key={item} className="output">{item}</p>)}
      </div>
    </div >
  );
}

export default App;
