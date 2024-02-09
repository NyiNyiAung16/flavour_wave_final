
const filteredById = (search,items)=>{
    if(search){
        return items.filter((item) =>{
            return parseInt(item.id) === parseInt(search);
        });
    }else{
        return items;
    }
};

const filteredByName = (search,items)=>{
    if(search){
        return items.filter((item) =>{
            return item.name.toLowerCase().includes(search.toLocaleLowerCase().trim());
        });
    }else{
        return items;
    }
};

export { filteredById, filteredByName }