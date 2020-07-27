const txtElement = ['Photography'];
let count = 0;
let txtIndex = 0;
let current = '';
let word = '';

(function ketik()
{
    if(count == txtElement.length )
    {
        count = 0;
    }

    currentTxt = txtElement[count];

    word = currentTxt.slice(0, ++txtIndex);
    document.querySelector('.efek-text').textContent = word;
    
    if(word.length == currentTxt.length)
    {
        txtIndex = 0;
    }
    setTimeout(ketik,300);
})();