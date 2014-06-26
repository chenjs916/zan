/**
 * Created by chen on 14-6-14.
 */
document.getElementById('zan').onclick=function(e){
    var event = window.event?window.event:e;     //window.event: IE---e:火狐
    var elem = event.srcElement||event.target;  //srcElement:IE--target:火狐
    //alert(elem.id+"的值是"+elem.name);
    zan(elem.id,elem.name);
}
    var xmlHttp;
    function zan(action,vid){
        var vid;
        var action;

        if(window.ActiveObject){
            xmlHttp = new ActiveObject('Microsoft.XMLHTTP');
        }
        else if(window.XMLHttpRequest){
            xmlHttp = new XMLHttpRequest();
        }

        xmlHttp.open("GET","ding.php?action="+action+"&id="+vid,true);
        xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlHttp.send(null);
        xmlHttp.onreadystatechange = stateChanged;
    }

    function stateChanged(){
        if (xmlHttp.readyState==4 && xmlHttp.status == 200){

            str = xmlHttp.responseText;
            var feedback = new Array(); //定义一数组
            feedback = str.split(","); //字符分割

            if(feedback[1] == 1){
                var d = document.getElementById('ding');
                d.className="ding d-selected";
                d.innerHTML = feedback[0];
            }
            else if(feedback[1] == 0){
                var d = document.getElementById('cai');
                d.className="cai c-selected";
                d.innerHTML = feedback[0];
            }
            else if(feedback[1] == "zan"){
                var d = document.getElementById('ding');
                d.className="ding d-selected";
            }
            else if(feedback[1] == "cai"){
                var d = document.getElementById('cai');
                d.className="cai c-selected";
            }
            else{
                return 0;
            }

        }
    }