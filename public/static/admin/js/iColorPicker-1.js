/*Copyright(c)2009,www.supersite.me*/var imageUrl='/static/admin/images/color.png';function iColorShow(id,id2){var eICP=jQuery("#"+id2).position();jQuery("#iColorPicker").css({'top':eICP.top+(jQuery("#"+id).outerHeight())+"px",'left':(eICP.left)+"px",'width':'205px','position':'absolute'}).fadeIn("fast");jQuery("#iColorPickerBg").css({'position':'fixed','top':0,'left':0,'width':'100%','height':'100%'}).fadeIn("fast");var def=jQuery("#"+id).val();jQuery('#colorPreview span').text(def);jQuery('#colorPreview').css('background',def);jQuery('#color').val(def);var hxs=jQuery('#iColorPicker');for(i=0;i<hxs.length;i++){var tbl=document.getElementById('hexSection'+i);var tblChilds=tbl.childNodes;for(j=0;j<tblChilds.length;j++){var tblCells=tblChilds[j].childNodes;for(k=0;k<tblCells.length;k++){jQuery(tblChilds[j].childNodes[k]).unbind().mouseover(function(a){var aaa="#"+jQuery(this).attr('hx');jQuery('#colorPreview').css('background',aaa);jQuery('#colorPreview span').text(aaa)}).click(function(){var aaa="#"+jQuery(this).attr('hx');jQuery("#"+id).val(aaa).css("background",aaa);jQuery("#iColorPickerBg").hide();jQuery("#iColorPicker").fadeOut();jQuery(this)})}}}}this.iColorPicker=function(){jQuery("input.iColorPicker").each(function(i){if(i==0){jQuery(document.createElement("div")).attr("id","iColorPicker").css('display','none').html('<table class="pickerTable" id="pickerTable0"><thead id="hexSection0"><TR><TD STYLE="BACKGROUND:#FF0000;" HX="FF0000"></TD><TD STYLE="BACKGROUND:#FFFF00" HX="FFFF00"></TD><TD STYLE="BACKGROUND:#00FF00" HX="00FF00"></TD><TD STYLE="BACKGROUND:#00FFFF" HX="00FFFF"></TD><TD STYLE="BACKGROUND:#0000FF" HX="0000FF"></TD><TD STYLE="BACKGROUND:#FF00FF" HX="FF00FF"></TD><TD STYLE="BACKGROUND:#FFFFFF" HX="FFFFFF"></TD><TD STYLE="BACKGROUND:#EBEBEB" HX="EBEBEB"></TD><TD STYLE="BACKGROUND:#E1E1E1" HX="E1E1E1"></TD><TD STYLE="BACKGROUND:#D7D7D7" HX="D7D7D7"></TD><TD STYLE="BACKGROUND:#CCCCCC" HX="CCCCCC"></TD><TD STYLE="BACKGROUND:#C2C2C2" HX="C2C2C2"></TD><TD STYLE="BACKGROUND:#B7B7B7" HX="B7B7B7"></TD><TD STYLE="BACKGROUND:#ACACAC" HX="ACACAC"></TD><TD STYLE="BACKGROUND:#A0A0A0" HX="A0A0A0"></TD><TD STYLE="BACKGROUND:#959595" HX="959595"></TD></TR><TR><TD STYLE="BACKGROUND:#EE1D24" HX="EE1D24"></TD><TD STYLE="BACKGROUND:#FFF100" HX="FFF100"></TD><TD STYLE="BACKGROUND:#00A650" HX="00A650"></TD><TD STYLE="BACKGROUND:#00AEEF" HX="00AEEF"></TD><TD STYLE="BACKGROUND:#2F3192" HX="2F3192"></TD><TD STYLE="BACKGROUND:#ED008C" HX="ED008C"></TD><TD STYLE="BACKGROUND:#898989" HX="898989"></TD><TD STYLE="BACKGROUND:#7D7D7D" HX="7D7D7D"></TD><TD STYLE="BACKGROUND:#707070" HX="707070"></TD><TD STYLE="BACKGROUND:#626262" HX="626262"></TD><TD STYLE="BACKGROUND:#555555" HX="555555"></TD><TD STYLE="BACKGROUND:#464646" HX="464646"></TD><TD STYLE="BACKGROUND:#363636" HX="363636"></TD><TD STYLE="BACKGROUND:#262626" HX="262626"></TD><TD STYLE="BACKGROUND:#111111" HX="111111"></TD><TD STYLE="BACKGROUND:#000000" HX="000000"></TD></TR><TR><TD STYLE="BACKGROUND:#F7977A" HX="F7977A"></TD><TD STYLE="BACKGROUND:#FBAD82" HX="FBAD82"></TD><TD STYLE="BACKGROUND:#FDC68C" HX="FDC68C"></TD><TD STYLE="BACKGROUND:#FFF799" HX="FFF799"></TD><TD STYLE="BACKGROUND:#C6DF9C" HX="C6DF9C"></TD><TD STYLE="BACKGROUND:#A4D49D" HX="A4D49D"></TD><TD STYLE="BACKGROUND:#81CA9D" HX="81CA9D"></TD><TD STYLE="BACKGROUND:#7BCDC9" HX="7BCDC9"></TD><TD STYLE="BACKGROUND:#6CCFF7" HX="6CCFF7"></TD><TD STYLE="BACKGROUND:#7CA6D8" HX="7CA6D8"></TD><TD STYLE="BACKGROUND:#8293CA" HX="8293CA"></TD><TD STYLE="BACKGROUND:#8881BE" HX="8881BE"></TD><TD STYLE="BACKGROUND:#A286BD" HX="A286BD"></TD><TD STYLE="BACKGROUND:#BC8CBF" HX="BC8CBF"></TD><TD STYLE="BACKGROUND:#F49BC1" HX="F49BC1"></TD><TD STYLE="BACKGROUND:#F5999D" HX="F5999D"></TD></TR><TR><TD STYLE="BACKGROUND:#F16C4D" HX="F16C4D"></TD><TD STYLE="BACKGROUND:#F68E54" HX="F68E54"></TD><TD STYLE="BACKGROUND:#FBAF5A" HX="FBAF5A"></TD><TD STYLE="BACKGROUND:#FFF467" HX="FFF467"></TD><TD STYLE="BACKGROUND:#ACD372" HX="ACD372"></TD><TD STYLE="BACKGROUND:#7DC473" HX="7DC473"></TD><TD STYLE="BACKGROUND:#39B778" HX="39B778"></TD><TD STYLE="BACKGROUND:#16BCB4" HX="16BCB4"></TD><TD STYLE="BACKGROUND:#00BFF3" HX="00BFF3"></TD><TD STYLE="BACKGROUND:#438CCB" HX="438CCB"></TD><TD STYLE="BACKGROUND:#5573B7" HX="5573B7"></TD><TD STYLE="BACKGROUND:#5E5CA7" HX="5E5CA7"></TD><TD STYLE="BACKGROUND:#855FA8" HX="855FA8"></TD><TD STYLE="BACKGROUND:#A763A9" HX="A763A9"></TD><TD STYLE="BACKGROUND:#EF6EA8" HX="EF6EA8"></TD><TD STYLE="BACKGROUND:#F16D7E" HX="F16D7E"></TD></TR><TR><TD STYLE="BACKGROUND:#EE1D24" HX="EE1D24"></TD><TD STYLE="BACKGROUND:#F16522" HX="F16522"></TD><TD STYLE="BACKGROUND:#F7941D" HX="F7941D"></TD><TD STYLE="BACKGROUND:#FFF100" HX="FFF100"></TD><TD STYLE="BACKGROUND:#8FC63D" HX="8FC63D"></TD><TD STYLE="BACKGROUND:#37B44A" HX="37B44A"></TD><TD STYLE="BACKGROUND:#00A650" HX="00A650"></TD><TD STYLE="BACKGROUND:#00A99E" HX="00A99E"></TD><TD STYLE="BACKGROUND:#00AEEF" HX="00AEEF"></TD><TD STYLE="BACKGROUND:#0072BC" HX="0072BC"></TD><TD STYLE="BACKGROUND:#0054A5" HX="0054A5"></TD><TD STYLE="BACKGROUND:#2F3192" HX="2F3192"></TD><TD STYLE="BACKGROUND:#652C91" HX="652C91"></TD><TD STYLE="BACKGROUND:#91278F" HX="91278F"></TD><TD STYLE="BACKGROUND:#ED008C" HX="ED008C"></TD><TD STYLE="BACKGROUND:#EE105A" HX="EE105A"></TD></TR><TR><TD STYLE="BACKGROUND:#9D0A0F" HX="9D0A0F"></TD><TD STYLE="BACKGROUND:#A1410D" HX="A1410D"></TD><TD STYLE="BACKGROUND:#A36209" HX="A36209"></TD><TD STYLE="BACKGROUND:#ABA000" HX="ABA000"></TD><TD STYLE="BACKGROUND:#588528" HX="588528"></TD><TD STYLE="BACKGROUND:#197B30" HX="197B30"></TD><TD STYLE="BACKGROUND:#007236" HX="007236"></TD><TD STYLE="BACKGROUND:#00736A" HX="00736A"></TD><TD STYLE="BACKGROUND:#0076A4" HX="0076A4"></TD><TD STYLE="BACKGROUND:#004A80" HX="004A80"></TD><TD STYLE="BACKGROUND:#003370" HX="003370"></TD><TD STYLE="BACKGROUND:#1D1363" HX="1D1363"></TD><TD STYLE="BACKGROUND:#450E61" HX="450E61"></TD><TD STYLE="BACKGROUND:#62055F" HX="62055F"></TD><TD STYLE="BACKGROUND:#9E005C" HX="9E005C"></TD><TD STYLE="BACKGROUND:#9D0039" HX="9D0039"></TD></TR><TR><TD STYLE="BACKGROUND:#790000" HX="790000"></TD><TD STYLE="BACKGROUND:#7B3000" HX="7B3000"></TD><TD STYLE="BACKGROUND:#7C4900" HX="7C4900"></TD><TD STYLE="BACKGROUND:#827A00" HX="827A00"></TD><TD STYLE="BACKGROUND:#3E6617" HX="3E6617"></TD><TD STYLE="BACKGROUND:#045F20" HX="045F20"></TD><TD STYLE="BACKGROUND:#005824" HX="005824"></TD><TD STYLE="BACKGROUND:#005951" HX="005951"></TD><TD STYLE="BACKGROUND:#005B7E" HX="005B7E"></TD><TD STYLE="BACKGROUND:#003562" HX="003562"></TD><TD STYLE="BACKGROUND:#002056" HX="002056"></TD><TD STYLE="BACKGROUND:#0C004B" HX="0C004B"></TD><TD STYLE="BACKGROUND:#30004A" HX="30004A"></TD><TD STYLE="BACKGROUND:#4B0048" HX="4B0048"></TD><TD STYLE="BACKGROUND:#7A0045" HX="7A0045"></TD><TD STYLE="BACKGROUND:#7A0026" HX="7A0026"></TD></TR></thead><tbody><tr><td style="border:1px solid #000;background:#fff;cursor:pointer;height:60px;-moz-background-clip:-moz-initial;-moz-background-origin:-moz-initial;-moz-background-inline-policy:-moz-initial;" colspan="16" align="center" id="colorPreview"><span style="color:#000;border:1px solid rgb(0, 0, 0);padding:5px;background-color:#fff;font:11px Arial, Helvetica, sans-serif;"></span></td></tr></tbody></table><style>#iColorPicker input{margin:2px}</style>').appendTo(".iColor-Picker");jQuery(document.createElement("div")).attr("id","iColorPickerBg").click(function(){jQuery("#iColorPickerBg").hide();jQuery("#iColorPicker").fadeOut()}).appendTo("body");jQuery('table.pickerTable td').css({'width':'12px','height':'14px','border':'1px solid #000','cursor':'pointer'});jQuery('#iColorPicker table.pickerTable').css({'border-collapse':'collapse'});jQuery('#iColorPicker').css({'border':'1px solid #ccc','background':'#333','padding':'5px','color':'#fff','z-index':9999})}jQuery('#colorPreview').css({'height':'50px'});jQuery(this).css({backgroundColor:jQuery(this).val()}).after('<span style=' + "cursor:pointer; position: relative;" + ' id="icp_'+this.id+'" class="iColorPicker-btn" onclick="iColorShow(\''+this.id+'\',\'icp_'+this.id+'\')"><img src="'+imageUrl+'" style="border:0;margin:7px 0 0 4px" align="absmiddle" ></span>')})};jQuery(function(){iColorPicker()})

function stopPropagation(e) {
    if (e.stopPropagation)
        e.stopPropagation();
    else
        e.cancelBubble = true;
}

$(document).bind('click',function(){
    $('#iColorPicker').fadeOut();
});

$('body').on('click','.iColorPicker-btn',function(e){
    stopPropagation(e);
});