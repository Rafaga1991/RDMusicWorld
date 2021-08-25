var onClick = {
    home: {
        event: null,
        getMinut: (second_t) => {
            let minute = 0;
            let second = 0;
            for(let i=0; i < second_t; i++){
                second++;
                if(second >= 60){
                    minute++;
                    second = 0;
                }
            }
            return minute + ':' + second;
        },
        getPercent: (start, end) =>{
            return Math.round(start / (end * 0.01));
        },
        pause: () => {
            onClick.home.event.sound.className = 'fas fa-play';
            $('#' + onClick.home.event.elementid)[0].pause();
        },
        play: (e, elementid) => {
            if (onClick.home.event !== null) {
                if (onClick.home.event.sound != null) {
                    if (onClick.home.event.sound !== e) {
                        onClick.home.pause();
                        onClick.home.event = {
                            sound: e,
                            elementid: elementid,
                            volume: '0.5'
                        };
                    }
                }
            }

            if (onClick.home.event === null) {
                onClick.home.event = {
                    sound: e,
                    elementid: elementid,
                    volume: '0.5'
                };
            } else if (onClick.home.event.sound === null) {
                onClick.home.event.sound = e;
            }

            if (e.className === 'fas fa-play') {
                e.className = 'fas fa-pause';
                $('#' + elementid)[0].volume = onClick.home.event.volume;
                $('#' + elementid)[0].play();
            } else {
                onClick.home.pause();
            }

            $('#' + elementid)[0].ontimeupdate = () => {
                let percent = onClick.home.getPercent($('#' + elementid)[0].currentTime, $('#' + elementid)[0].duration);
                $('#' + $(e).attr('time'))[0].innerHTML = onClick.home.getMinut($('#' + elementid)[0].currentTime) + ' / ' + onClick.home.getMinut($('#' + elementid)[0].duration);
                $('#' + $(e).attr('progress'))[0].style.width = percent + '%';
                
            }
        },
        stop: () => {
            if (onClick.home.event != null) {
                var volume = $('#' + onClick.home.event.elementid)[0].volume;
                $('#' + onClick.home.event.elementid)[0].load();
                $('#' + onClick.home.event.elementid)[0].volume = volume;
                onClick.home.event.sound.className = 'fas fa-play';
            }
        },
        volume: (e, elementid) => {
            $('#' + elementid)[0].volume = (e.value / 100);
            if (onClick.home.event === null) {
                onClick.home.event = {
                    sound: null,
                    elementid: elementid,
                    volume: $('#' + elementid)[0].volume
                };
            }
            onClick.home.event.volume = $('#' + elementid)[0].volume;
        },
        hidden: (elementid)=>{
            $('#' + elementid)[0].hidden = !$('#' + elementid)[0].hidden;
        },
        like: (e, idMusic)=>{
            $.post(
                './?view=home',
                {
                    idMusic: idMusic
                }, (data)=>{
                    if($(e)[0].className === 'fas fa-thumbs-up'){
                        $(e)[0].className = 'far fa-thumbs-up';
                    }else{
                        $(e)[0].className = 'fas fa-thumbs-up';
                    }
                }
            );
        }
    }
};