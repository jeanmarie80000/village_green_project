import React, {useEffect, useState, createContext, useContext} from "react";
import axios from "axios";

export default function ProductList() {

    const [data, setData] = useState([]);
    // const context = createContext(setData);
    
    useEffect(() => {
        axios.get('https://127.0.0.1:8000/api/products')
            .then( res => 
                // setData(res.data)
                console.log(res.data)
                )
                .catch(error => console.log(error));
            }, []);
        
            
        return (
            <div>
                <h3>Liste des produits (React, temporaire)</h3>
                <ul>
                    {
                        data.map( (product, index) =>
                            <li key={index}>{product.name}</li>
                        )
                    }
                </ul>
            </div>
        )
}