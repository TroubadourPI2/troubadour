 
    document.addEventListener("mousemove", DeplacerPupilles);

  
    function DeplacerPupilles(e) {
   
        document.querySelectorAll('.oeil').forEach(oeil => {
            const zoneOeil = oeil.getBoundingClientRect();
       
            const centreOeilX = zoneOeil.left + zoneOeil.width / 2;
            const centreOeilY = zoneOeil.top + zoneOeil.height / 2;
            
        
            let decalageX = e.clientX - centreOeilX;
            let decalageY = e.clientY - centreOeilY;
            
           
            const decalageMax = 25; 
            const distanceCurseur = Math.sqrt(decalageX * decalageX + decalageY * decalageY);

            if (distanceCurseur > decalageMax) {
                const rapport = decalageMax / distanceCurseur;
                decalageX *= rapport;
                decalageY *= rapport;
            }
            
       
            const imageOeil = oeil.querySelector('.imageOeil');
       
            imageOeil.style.transform = `translate(${decalageX}px, ${decalageY}px)`;
        });
    }