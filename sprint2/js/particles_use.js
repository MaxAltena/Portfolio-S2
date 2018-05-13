particlesJS('splash', {
    "particles": {
        "number": {
            "value": 150,
            "density": {
                "enable": true,
                "value_area": 750
            }
        },
        "color": {
            "value": "#DEDEDE"
        },
        "shape": {
            "type": "circle",
            "stroke": {
                "width": 0,
                "color": "#000000"
            },
            "polygon": {
                "nb_sides": 0
            },
            "image": {
                "src": "",
                "width": 0,
                "height": 0
            }
        },
        "opacity": {
            "value": 0.5,
            "random": true,
            "anim": {
                "enable": true,
                "speed": 0.5,
                "opacity_min": 0.1,
                "sync": false
            }
        },
        "size": {
            "value": 3,
            "random": true,
            "anim": {
                  "enable": true,
                  "speed": 0.5,
                  "size_min": 0.1,
                  "sync": false
            }
        },
        "line_linked": {
            "enable": true,
            "distance": 150,
            "color": "#DEDEDE",
            "opacity": 0.4,
            "width": 1
        },
        "move": {
            "enable": true,
            "speed": 5,
            "direction": "none",
            "random": false,
            "straight": false,
            "out_mode": "bounce",
            "attract": {
                "enable": false,
                "rotateX": 0,
                "rotateY": 0
            }
        }
    },
    "interactivity": {
        "detect_on": "canvas",
        "events": {
            "onhover": {
                "enable": true,
                "mode": "grab"
            },
            "onclick": {
                "enable": true,
                "mode": "push"
            },
            "resize": true
        },
        "modes": {
            "grab": {
                "distance": 200,
                "line_linked": {
                    "opacity": 1
                }
            },
            "bubble": {
                "distance": 200,
                "size": 10,
                "duration": 2,
                "opacity": 1,
                "speed": 1
            },
            "repulse": {
                "distance": 100
            },
            "push": {
                "particles_nb": 5
            },
            "remove": {
                "particles_nb": 0
            }
        }
    },
    "retina_detect": true
});