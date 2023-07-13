import React, {useEffect, useState, createContext, useContext} from "react";
import axios from "axios";
import Hello from "../controllers/Hello";
import { object } from "prop-types";

export default function ProductList() {

    const [array, setArray] = useState([]);
    // const context = createContext(setData);
    const url = 'https://127.0.0.1:8000/api/products';
    
    useEffect(() => {
        axios.get(url)
            .then( (res) =>  {
                setArray(res.data);
                // console.log(res.data);
                })
                .catch(error =>
                    console.log(error)
                    );
            }, []
        );

        // const val = Object.values(array);
        console.log(array);
        
        return (
            <div>
                <Hello />
                <ul>
                </ul>
            </div>
        )
}