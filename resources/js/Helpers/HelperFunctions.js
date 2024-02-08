const cleanString = (string = '') => {
    if(string.length > 0) {
        const regex = /^(<(p|i|strong)>)+|(<\/(p|i|strong)>)+$/g;
        return string.replace(regex, '');
    } else {
        return string;
    }
};

export default cleanString;