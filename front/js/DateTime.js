const DateTime = class {
    constructor() { }

    refreshDateLayer = () => {
        let date = new Date();
    
        let language  = "en-EN";
        
        let todayDate = date.toLocaleDateString(language, { year: 'numeric', month: 'long', day: 'numeric' })
    
        let dayOfWeek = date.toLocaleString(language, { weekday: 'long' })
    
        let time = date.toLocaleTimeString(language, { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    
        dataLayer.innerHTML = `Today is ${dayOfWeek}, ${todayDate} <br> ${time}`;
    }

    get daysOfWeek() {
        Date.prototype.addDays = function(days) {
            var date = new Date(this.valueOf());
            date.setDate(date.getDate() + days);
            return date;
        }

        let date = new Date();
        let daysOfWeek = [];
    
        [...Array(7).keys()].forEach(i => {
             daysOfWeek.push(date.addDays(i).toLocaleString("en-EN", { weekday: 'long' }))
        })

        return daysOfWeek;
    }

   
}
    


export { DateTime }