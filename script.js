
console.log("heklloxzjfhvsdf");


var blur = document.querySelector("#cursorblur")

document.addEventListener("mousemove",function(dets){
    blur.style.left= dets.x - 150 + "px"
    blur.style.top = dets.y - 150 + "px"
})


gsap.to("#nav",{
    backgroundColor: "#0F2340",
    height:"95px",
    duration:0.1,
    scrollTrigger:{
        trigger:"#nav",
        scroller:"body",
        // markers:true,
        start:"top -10%",
        end: "top -11%",
        scrub:1,
    },
});

gsap.to("#main" , {
    backgroundColor:"black",
    scrollTrigger:{
        trigger:"#dull",
        scroller:"body",
        // marker:true,
        start:"top -40%",
        end:"top -100%",
        scrub:4
    }

})

gsap.from(".about img" , {
    x:15,
    y:15,
    scale:0.5,
    duration:1,
    scrollTrigger:{
        trigger:"#dull",
        scroller:"body",
        // marker:true,
        start:"top -40%",
        end:"top -100%",
        scrub:2
    }
})
gsap.from(".about h2 ,.about p , .col" , {
    x:15,
    y:15,
    scale:0.8,
    duration:1,
    scrollTrigger:{
        trigger:"#dull",
        scroller:"body",
        // marker:true,
        start:"top -40%",
        end:"top -100%",
        scrub:3
    }
})

