$(document).ready(function(){    
    
    function codify(str){
        str = cs1(str);
        str = cs2(str);
        str = cs3(str);
        //str = cs4(str);
        str = cs5(str);
        return  str;
    }
    
    function decodify(str){
        str = anti_cs5(str);
        //str = anti_cs4(str);
        str = anti_cs3(str);
        str = anti_cs2(str);
        str = anti_cs1(str);
        return  str;
    }
    
    function cs1(str){
        k=0;
        var new_str=new Array();
        for(i=0;i<str.length;i++){
            if(i%2===0){                
                new_str[k]=getRandomArbitrary(0,9);                
                k++;
                new_str[k]=str[i];
            }
            else
                new_str[k]=str[i];
            k++;
        }        
        new_str=new_str.toString();
        return new_str.replace(/,/g,'');
    }
    
    function anti_cs1(str){
        k=0;
        var new_str=new Array();
        for(i=0;i<str.length;i++){
            if(i%3===0){                
//                new_str[k]=getRandomArbitrary(0,9);                
//                k++;
//                new_str[k]=str[i];
            }
            else
                new_str[k]=str[i];
            k++;
        }        
        new_str=new_str.toString();
        return new_str.replace(/,/g,'');
    }
    
    function cs2(str){        
        var new_str=new Array();
        for(i=0;i<str.length;i++){ 
            tmp=str[i].charCodeAt(0)+13;                        
            new_str[i]=String.fromCharCode(tmp);
        }
        new_str=new_str.toString();
        return new_str.replace(/,/g,'');
    }
    
    function anti_cs2(str){        
        var new_str=new Array();
        for(i=0;i<str.length;i++){ 
            tmp=str[i].charCodeAt(0)-13;                        
            new_str[i]=String.fromCharCode(tmp);
        }
        new_str=new_str.toString();
        return new_str.replace(/,/g,'');
    }
    
    function cs3(str){
        k=0;
        var new_str=new Array();
        for(i=0;i<str.length;i++){
            if(i%5===0){                
                new_str[k]=getRandomArbitrary(0,9);                
                k++;
                new_str[k]=str[i];
            }
            else
                new_str[k]=str[i];
            k++;
        }        
        new_str=new_str.toString();
        return new_str.replace(/,/g,'');
    }
    
    function anti_cs3(str){
        k=0;
        var new_str=new Array();
        for(i=0;i<str.length;i++){
            if(i%6===0){                
//                new_str[k]=getRandomArbitrary(0,9);                
//                k++;
//                new_str[k]=str[i];
            }
            else
                new_str[k]=str[i];
            k++;
        }        
        new_str=new_str.toString();
        return new_str.replace(/,/g,'');
    }
    
    function cs4(str){
        var new_str=new Array();
        for(i=0;i<str.length;i++){ 
            tmp=str[i].charCodeAt(0)*2;                        
            new_str[i]=String.fromCharCode(tmp);
        }
        new_str=new_str.toString();
        return new_str.replace(/,/g,'');
    }
    
    function anti_cs4(str){
        var new_str=new Array();
        for(i=0;i<str.length;i++){ 
            tmp=str[i].charCodeAt(0)/2;                        
            new_str[i]=String.fromCharCode(tmp);
        }
        new_str=new_str.toString();
        return new_str.replace(/,/g,'');
    }
    
    function cs5(str){
        var new_str=new Array();
        k=0;
        for(i=str.length-1;i>=0;i--){                       
            new_str[k]=str[i];
            k++;
        }
        new_str=new_str.toString();
        return new_str.replace(/,/g,'');
    }
    
    function anti_cs5(str){
        var new_str=new Array();
        k=0;
        for(i=str.length-1;i>=0;i--){                       
            new_str[k]=str[i];
            k++;
        }
        new_str=new_str.toString();
        return new_str.replace(/,/g,'');
    }
    
    function getRandomArbitrary(min, max) {
        return parseInt(Math.random() * (max - min) + min);
    }
    
    
    
        
});

