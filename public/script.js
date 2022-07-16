$(document).ready(function() {

    $(".btn-stop").on('click', function (){
        location.reload();
        return false;

    })

    let hod = 0;
    let mass1 = ['','','','','','','','','']
    let hidden = document.getElementById("hidden");
    function responseAns(data){
        console.log(data.java)
    }
    function checkWin(cells){
        let combs = [
            [0, 1, 2],
            [3, 4, 5],
            [6, 7, 8],
            [0, 3, 6],
            [1, 4, 7],
            [2, 5, 8],
            [0, 4, 8],
            [2, 4, 6],
        ];
        for (let comb of combs) {
            if (
                cells[comb[0]].innerHTML == cells[comb[1]].innerHTML &&
                cells[comb[1]].innerHTML == cells[comb[2]].innerHTML &&
                cells[comb[0]].innerHTML != ''
            )
            {
                cells[comb[0]].style.background = "orange";
                cells[comb[1]].style.background = "orange";
                cells[comb[2]].style.background = "orange";

                return true;
            }
        }
        return false;
    }
    let blocks = $(".btn-game")
    for (const block of blocks) {

        block.addEventListener('click',function send(event) {
            var target = event.target;
            let k = 0;
            let j = 0;
            console.log()
            for (let i = 0; i < blocks.length; i++) {
                if(mass1[i]=='' && target == blocks[i]){
                    target.innerHTML  =  'X';
                    mass1[i] = 'X'
                    this.removeEventListener('click', send);
                    break;
                }
            }
            hod++;
            if(checkWin(blocks))
                result = 1;
            else if (!checkWin(blocks) && hod == 9)
                result = 2
            else
                result = 0;

            $.ajax({
                type: "POST",
                url: "botResponse.php",

                data: {
                    'fields' : mass1,
                    'result' :  result,
                    'session_var': hidden.innerHTML
                },
                success: function(response)
                {
                    setTimeout(function (){
                        let data = JSON.parse(response);
                        if(data.fieldExist == true)
                        {
                            mass1[data.fieldO] = '0';
                            blocks[data.fieldO].innerHTML = 0;
                            blocks[data.fieldO].removeEventListener('click', send);

                        }
                        if(data.game == 1){
                            alert(data.msg);
                            checkWin(blocks);
                            return;
                        }
                        hod++;
                        console.log(hod);
                    },1000)

                }
            });
        })

    }


});