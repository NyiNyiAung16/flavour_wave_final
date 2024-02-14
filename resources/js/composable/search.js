
const filteredById = (search,items,searchId = 'id')=>{
    if(search){
        return items.filter((item) =>{
            return parseInt(item[searchId]) === parseInt(search);
        });
    }else{
        return items;
    }
};

const filteredByName = (search,items,searchName = 'name')=>{
    if(search){
        return items.filter((item) =>{
            return item[searchName].toLowerCase().includes(search.toLocaleLowerCase().trim());
        });
    }else{
        return items;
    }
};

export { filteredById, filteredByName }