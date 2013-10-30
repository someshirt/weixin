<?php
class Articies{
   
    // 发送图文信息
    public function retImgTex($Title, $ArticleCount, $Description, $PicUrl, $Url,$postObj){ // 测试成功 
        $imgtextTpl = "
                   <xml>
                   <ToUserName><![CDATA[%s]]></ToUserName>
                   <FromUserName><![CDATA[%s]]></FromUserName>
                   <CreateTime>%s</CreateTime>
                   <MsgType><![CDATA[%s]]></MsgType>
                   <ArticleCount>%s</ArticleCount>
                   <Articles>
                   <item>
                   <Title><![CDATA[%s]]></Title> 
                   <Description><![CDATA[%s]]></Description>
                   <PicUrl><![CDATA[%s]]></PicUrl>
                   <Url><![CDATA[%s]]></Url>
                   </item>
                   <item>
                   <Title><![CDATA[%s]]></Title> 
                   <Description><![CDATA[%s]]></Description>
                   <PicUrl><![CDATA[%s]]></PicUrl>
                   <Url><![CDATA[%s]]></Url>
                   </item>
                   <item>
                   <Title><![CDATA[%s]]></Title> 
                   <Description><![CDATA[%s]]></Description>
                   <PicUrl><![CDATA[%s]]></PicUrl>
                   <Url><![CDATA[%s]]></Url>
                   </item>
                   <item>
                   <Title><![CDATA[%s]]></Title> 
                   <Description><![CDATA[%s]]></Description>
                   <PicUrl><![CDATA[%s]]></PicUrl>
                   <Url><![CDATA[%s]]></Url>
                   </item>
                   <item>
                   <Title><![CDATA[%s]]></Title> 
                   <Description><![CDATA[%s]]></Description>
                   <PicUrl><![CDATA[%s]]></PicUrl>
                   <Url><![CDATA[%s]]></Url>
                   </item>
                   </Articles>
                   </xml> 
                   ";    
        // 返回图文消息模式
        $msgType = "news";
        $time = time($postObj);
        $resultStr = sprintf($imgtextTpl, $postObj->FromUserName, $postObj->ToUserName, $time, $msgType, $ArticleCount,$Title,$Description,$PicUrl,$Url,
                             
                            "十条Tips教会你做时间管理", 
                             "其实，这个问题我在刚来公司很长一段时间也存在过，现在其实也没能完全解决这个问题，每天的时间非常不够用，想要拿出一块很完整的时间来专心做一件事",
                             "http://tpai.qq.com/upload/public/common/images/2013/08/240_144_13153039323.jpg",
                             "http://tpai.qq.com/article/view/126",
                             
                             "如何估算香港迪士尼乐园一年的收入？",
                             "估算迪士尼乐园一年的收入，这种题目是在面试时会经常遇到的，那么该怎么做呢？",
                             "http://tpai.qq.com/upload/public/common/images/2013/08/240_144_02142832705.jpg",
                             "http://tpai.qq.com/article/view/125",
                             
                             "我工作一年半中遇到的三个问题",
                             "你如何看待那些整天把『张小龙说过balabala』/『乔布斯说过balabala』这些话挂在嘴边的人？ 你觉得产品经理与艺术家有什么区别？你觉得微信朋友圈中长",
                             "http://tpai.qq.com/upload/public/common/images/2013/08/240_144_02114100786.jpg",
                             "http://tpai.qq.com/article/view/124",
                             
                             "他是如何“黑”到腾讯实习生的offer的",
                             "钱文祥的个人经历和普通的学生相比没有什么过人之处，可如果你知道他是因为像黑客一样找到了QQ浏览器的安全漏洞，所以被公司同事发现邀请实习之后，是不",
                             "http://tpai.qq.com/upload/public/common/images/2013/07/240_144_31100231810.jpg",
                             "http://tpai.qq.com/article/view/123"
                            
                            );
        
        echo $resultStr;
    }
    
};
?>