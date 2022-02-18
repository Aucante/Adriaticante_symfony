import Dropzone from "dropzone";

import "dropzone/dist/dropzone.css";
import "./styles/dropzone.scss";


const myDropzone = new Dropzone("#my-form");

const output = document.querySelector("#output");

myDropzone.on("addedfile", (file) => {
    // Add an info line about the added file for each file.
    output.innerHTML += `<div>File added: ${file.name}</div>`;
});