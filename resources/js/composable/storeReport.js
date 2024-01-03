export default function storeReport(data){
    const array = JSON.parse(localStorage.getItem('reports')) ?? [];
    if(!array.includes(data)){
        array.push(data);
    }
    localStorage.setItem('reports',JSON.stringify(array));
}