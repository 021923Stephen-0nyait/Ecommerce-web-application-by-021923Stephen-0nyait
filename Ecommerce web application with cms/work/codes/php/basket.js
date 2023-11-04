"use strict";

//Globals
window.onload = loadBasket;

//Get basket from session storage or create one if it does not exist
function getBasket(){
    let basket;
    if(sessionStorage.basket === undefined || sessionStorage.basket === ""){
        basket = [];
    }
    else {
        basket = JSON.parse(sessionStorage.basket);
    }
    return basket;
}

//Displays basket in page.
function loadBasket(){
    let basket = getBasket();//Load or create basket
    
    //Build string with basket HTML
    let htmlStr = "<form action='checkout.php' method='post'>";
    let prodIDs = [];
    for(let i=0; i<basket.length; ++i){
        prodIDs.push({id: basket[i].id, count: basket[i].count, price: basket[i].price});//Add to product array
    }
    //Add hidden field to form that contains stringified version of product ids.
    htmlStr += "<input type='hidden' name='prodIDs' value='" + JSON.stringify(prodIDs) + "'>";
    
    //Add checkout and empty basket buttons
    htmlStr += "<input type='submit' value='Checkout'></form>";
    htmlStr += "<br><button onclick='emptyBasket()'>Empty Basket</button>";
    
    //Display nubmer of products in basket
    document.getElementById("basketDiv").innerHTML = htmlStr;


}

//Adds an item to the basket
function addToBasket(prodID, prodName, price){
    let basket = getBasket();//Load or create basket
    let findingStatus=0
    let indexOfFound =0
    //Add product to basket
    if(basket.length ==undefined || basket.length === "" || basket.length === 0){
        basket.push({id: prodID, name: prodName,count:1, price: price})
        sessionStorage.basket = JSON.stringify(basket);
        
    }
    
    else{
        for(let i=0;i<basket.length;i++){
            if(prodID==basket[i].id){
                findingStatus=1
                indexOfFound=i
                break
            }
        }
        
        if(findingStatus==1){

            if(basket[indexOfFound].count==1){
                let addingNum = Number(basket[indexOfFound].count)
                console.log(addingNum)
                basket[indexOfFound].count= addingNum+1
                console.log(basket[indexOfFound])
                sessionStorage.basket = JSON.stringify(basket)
                
               
            }
            else{
                let addingNum = Number(basket[indexOfFound].count)
                basket[indexOfFound].count= addingNum+1
                console.log(basket[indexOfFound])
                sessionStorage.basket = JSON.stringify(basket)
                
            }  
        }
        else{
            basket.push({id: prodID, name: prodName,count:1, price: price})
            sessionStorage.basket = JSON.stringify(basket);
        }
        findingStatus=0
    }
    
    //Store in local storage
    
    
    //Display basket in page.
    loadBasket();      
}

//Deletes all products from basket
function emptyBasket(){
    let basket = getBasket()
    let arrayLength = basket.length
    for(let i=0;i<arrayLength;i++){
        console.log(basket.length)
        basket.pop()
    }
    sessionStorage.basket = JSON.stringify(basket)
    loadBasket();
}

function checkout_msgs(){
    alert('Your order has well been received. Thank you for purchasing with Gateway!')
}

function checkoutUpdates(){
    let basket = getBasket()
    if(basket.length==0){
        alert('Your cart is empty!')
    }
    else{
        let sendhtml = "basket="
        for(let i=0;i<basket.length;i++){
            sendhtml+=basket[i].name
            sendhtml+=","
            console.log(basket[i].name)

        }
        sendhtml=sendhtml.substring(0,sendhtml.length-1)
        sendhtml+="&"
        sendhtml+="quantity="

        for(let i=0;i<basket.length;i++){
            sendhtml+=basket[i].price
            sendhtml+=","
            console.log(basket[i].price)

        }
        sendhtml=sendhtml.substring(0,sendhtml.length-1)
        sendhtml+="&"
        sendhtml+="price="
        
        for(let i=0;i<basket.length;i++){
            sendhtml+=basket[i].count
            sendhtml+=","
            console.log(basket[i].count)
        }
        sendhtml=sendhtml.substring(0,sendhtml.length-1)

        let d1 = new Date()
        let theday =d1.toDateString()
        let finalday = theday.replace(/\s/g,"/")
        sendhtml+='&dayof='
        sendhtml+=finalday
        console.log(sendhtml)

        let request = new XMLHttpRequest()   
        request.onload = function(){
            if (request.status ==200){
                console.log("Reached")
                let products = this.response
                if(products=="false"){
                    alert('You should register first to make a purchase with Gateway!')
                    window.location.href="Login.php"
                }
                else{
                    document.getElementById("checkOutput").innerHTML= products
                    checkout_msgs()  
                    emptyBasket()
                    clearBasket()
                }
            }
            else{
                alert("Error communicating with server: " + request.status);
                emptyBasket()
                clearBasket()
            }
        }
        
        request.open("POST", "shopping.php");
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        //Send request
        request.send(sendhtml);

    }    
}

function goback(){
    window.location.href="testBasket.php"
}


function outBasket(){
    window.location.href="cart.php"
}
function clearBasket(){
    document.getElementById("cart_items").innerHTML = "";
    alert('You cart has been cleared. Thank you!');
}

function addKeyword(){
    //Increase count of keyword
    let keywords=JSON.parse(localStorage.recommenderKeywords)
    let word =document.getElementById("productSearch").value
    if(keywords[word] === undefined)
        keywords[word] = {count: 1, date: new Date().getTime()};
    else{
        keywords[word].count++;
        keywords[word].date = new Date().getTime();
    }
    
    console.log(JSON.stringify(keywords));
    
    //Save state of recommender
    localStorage.recommenderKeywords = JSON.stringify(keywords)
}
function showRecomend(){
    var x = document.getElementById("ReccomendThis");  
    x.style.display = "block";
}
function getTopKeyword(){
    //Clean up old keywords
    let keywords=JSON.parse(localStorage.recommenderKeywords)
    //Return word with highest count
    let maxCount = 0;
    let maxKeyword = "";
    for(let word in keywords){
        if(keywords[word].count > maxCount){
            maxCount = keywords[word].count;
            maxKeyword = word;
        }
    }
    return maxKeyword;
}

function showRecommendation(){      
    showRecomend()      
    document.getElementById("ReccomendThis").innerHTML =""
    let productNameTyped = getTopKeyword()
    let productName= "searchServer.php?product="
    productName +=productNameTyped
    let searchResult = new XMLHttpRequest()

    searchResult.open("GET", productName)
    
    searchResult.onload = function(){
        if (searchResult.status ==200){
            console.log("Reached")
            let products = this.response
            let checkArray = products.indexOf("]")
            let theTableData= "<table class='toleft'><th colspan='2'>You could like these</th>"
            if (checkArray>-1){
                let convertArray =JSON.parse(products)
                console.log(convertArray)
                for(let i=0;i<convertArray.length;i++){
                    let ids =convertArray[i].productID
                    let idnum =ids["$oid"]
                    
                    
                    const productsfound = document.createElement("div")
                    theTableData += "<tr>"+'<td style="background-color:#E3CDC7"><img width=200 height=200 src="'+convertArray[i].image+'"></td>'+"<td>NAME: "+convertArray[i].product+"</td>"+"<td>PRICE: "+convertArray[i].price+"</td>"+"<td><button class='searchbtns' onclick='addToBasket("+'"'+idnum+'"'+","+'"'+convertArray[i].product+'"'+")'>Add to Cart</button></td>"+"</tr>"  
                    
                }

                theTableData += "</table>"
                const productsfound = document.createElement("div")
                productsfound.innerHTML = theTableData
                document.getElementById("ReccomendThis").appendChild(productsfound)
                
            }
            else{
                document.getElementById("ReccomendThis").innerHTML="<h1>"+ products+"</h1>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"+"</br>"
            }

        
            
        }
        else{
            alert("Error communicating with server: " + searchResult.status);
        }
    }
    searchResult.send()

}

function ascending(){
    console.log("reached")
    document.getElementById("displayProducts").innerHTML =""
    let productName= "sortProducts.php?order=ascend"
    console.log(productName)
    let searchResult = new XMLHttpRequest()

    searchResult.open("GET", productName)
   
    searchResult.onload = function(){
        if (searchResult.status ==200){
            console.log("Reached")
            let products = this.response
            console.log(products)
            document.getElementById("displayProducts").innerHTML =products
            console.log(products)
        }
        else{
            alert("Error communicating with server: " + searchResult.status);
        }
    }
    searchResult.send()
   
}

function descending(){
    console.log("reached")
    document.getElementById("displayProducts").innerHTML =""
    let productName= "sortProducts.php?order=descend"
    console.log(productName)
    let searchResult = new XMLHttpRequest()

    searchResult.open("GET", productName)
   
    searchResult.onload = function(){
        if (searchResult.status ==200){
            console.log("Reached")
            let products = this.response
            console.log(products)
            document.getElementById("displayProducts").innerHTML =products
            console.log(products)
        }
        else{
            alert("Error communicating with server: " + searchResult.status);
        }
    }
    searchResult.send()
   
}

