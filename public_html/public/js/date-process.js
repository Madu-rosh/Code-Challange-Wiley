var processedDate = {
    initialize : function (){
        processedDate.assign();
        setInterval(function(){
            processedDate.loop();
        }, 1000);
    },
    assign: function(){
        let elements = document.getElementsByClassName('js-date-format')
        for(let i = 0; i < elements.length; i++){
            let date = new Date(elements[i].innerHTML);
            elements[i].setAttribute('original_time', date.toISOString().split('.')[0]+"Z" );
        }
    },
    find: function (){
        let className = 'js-date-format';
        let elements = document.getElementsByClassName(className);
        return elements;
    },
    iterate: function(elements){
       for(let i = 0; i < elements.length; i++){
           elements[i].innerHTML = processedDate.rewrite(elements[i].getAttribute('original_time'));
       }
    },
    rewrite: function (info){
        let date = new Date(info);
        let now = new Date();
        now = new Date(now.toISOString().split('.')[0]+"Z"); //correcting milliseconds discrepancies

        let diff = Math.abs(date - now) / 1000;

        if(diff < 60){
            return diff + ' seconds  ago';
        }
        else if(diff < 3600){
            let minutes = Math.floor((diff / 60));
            let desc = ((minutes == 1) ? 'minute' : 'minutes');
            return `${minutes} ${desc} ago`;
        }
        else if(diff < 86400){
            let hours = Math.floor((diff / 3600));
            let desc = ((hours == 1) ? 'hour' : 'hours');
            return `${hours} ${desc} ago`;
        }
        return info;
    },
    loop: function (){
        processedDate.iterate(processedDate.find());
    }
}