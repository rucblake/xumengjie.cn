<?php

namespace App\Libraries\Util;

/**
 * Created by PhpStorm.
 * User: yangwenqing001
 * Date: 2019/3/6
 * Time: 15:35
 */
class CommentsUtil
{
    public static $count = null;

    public static function randomComment()
    {
        if (empty(self::$count)) {
            self::$count = count(self::COMMENTS);
        }
        $rand = mt_rand(0, self::$count - 1);
        return self::COMMENTS[$rand];
    }

    const COMMENTS = [
        "嗯这条不错。徐梦洁我喜欢你很久了，我这个人也希望你了解一下。",
        "加油哦梦洁，你真的好可爱，以后的路我们就一起走下去吧，点播一首真的爱你！",
        "每个人对自己的喜欢都不遗余力。虽然每天都很忙但是看到你的微博还是会很开心哈哈，晚安哦小彩虹徐梦洁，愿你天天开心工作顺利哦。",
        "小彩虹~我每天都在努力为你营业哦！今天又向好几个朋友安利了你！从你比赛期间我就一直在关注你啦，希望你日后能越来越红！",
        "我的宝贝彩虹啊，你可能永远也不会知道我有多喜欢你。看你的直拍入坑到现在，一直沉迷你的美颜和舞台表现不能自拔，希望以后能有机会亲眼见到你吧。",
        "超喜欢你啊小彩虹~最初入坑是因为你家的烧烤（其实是油炸）实在是太诱人了，后来发现你本人比烧烤还有魅力，有机会一定要去金华吃一次你家的烧烤，看看你长大的地方。",
        "每次看到你都有种想从妈妈粉变成男友粉的冲动，这位女士能不能不要逼我的爱变质。",
        "彩虹啊熬夜工作一定很辛苦，记得多喝水、按时吃饭、早点睡觉、不要熬夜熬得太晚了，这样很容易水肿哦会不好看的（来自一个妈妈粉的叮嘱）",
        "新的一天新的爱你~撒拉嘿呦小彩虹，我们爱你小彩虹！",
        "翻遍你的微博，你真是可甜可盐本人了。小彩虹，加油吧，期待你越来越红。",
        "可爱的治愈系小姐姐，看到你的笑颜真的世界都美好了。一直就这么微笑下去吧小彩虹，我们会陪你走彩虹路的。",
        "因为那支木偶舞喜欢上你，虽然当时的妆容怪怪的，不过不影响你出彩啊。当初还有点害羞的小女孩现在真的长大了，看着你出道以后一点一点变得更好，打心里为你开心。",
        "妹妹为什么这么可爱，不愧叫小彩虹，笑起来真是跟彩虹一样美。",
        "女鹅啊一定要好好照顾自己。工作之余也要记得养生啊，虹妈每天都在为你操心。",
        "小可爱徐梦洁，加油吧，努力实现你的梦想",
        "多喝热水，多发自拍，多多互动，本彩虹雨满足了",
        "幸好你出道了，不然这样的美颜埋没在小剧场里太可惜了。",
        "我越喜爱你越可爱。这种女孩徐梦洁，入股不亏徐梦洁。",
        "不怎么追星但还是被你击中内心。感谢土创这个节目让我认识你，今后一定会陪伴你一直走下去的",
        "姐我想你想的睡不着，以后多多上线营业吧救救我们这些快要疯魔的彩虹雨",
        "读虚读得心累，我要来看看彩虹放松一下",
        "徐老师你知道我们一直在痴痴地等你的自拍教程吗？哦还有健身教程，护肤教程也顺便推荐一下吧",
        "彩虹笑颜能迷倒万千 盛夏甜酒你值得拥有 徐梦洁加油  我爱你  ",
        "踩点狂魔了解一下 盛夏甜酒了解一下 梦幻彩虹了解一下 走过路过请不要错过这只潜力股",
        "每次看彩虹微博就像喝了一罐红牛，哈哈，本来背书背的困得要死看到你的自拍一下就醒了",
        "女鹅呀最近有没有好好练vocal啊，大家都在笑你的大白嗓呢，vocal不行很吃亏的哦，分part都只能分到很少，所以赶紧努力起来，妈妈要看你走彩虹路！",
        "宝贝你微博的风格变了好多哦。出道了不要有太大压力啦，我们喜欢看你的自拍啊日常啊轻轻松松的东西，当然了其实只要看到你我们就很开心了",
        "徐女士徐老师徐教练你知不知道我多喜欢你啊，以后请多多上线跟我们营业吧",
        "从蜜少时期就关注你了，小女孩，要狠狠红啊",
        "兰蔻找你拍广告真是有眼光，真的又清新又甜蜜，我中了你的毒出不去了",
        "小彩虹我真的很喜欢看你笑的样子，希望你永远能快快乐乐元气满满的",
        "我会和你一起一起变得更好的，小彩虹等我！",
        "可爱可爱可爱可爱死了的小彩虹！妈妈爱你！",
        "敲代码累了又来看看你，不累啦！工作去了",
        "太喜欢你了所以只希望你每天开心，不用曝光得这么频繁也可以的，我们也不会脱粉的",
        "喜欢你没道理好心情用不完。加油吧小彩虹，谢谢你给我一个这么美的梦",
        "好想你，想你家的烧烤，想你甜酒般的笑容，想你想的睡不着",
        "私信你了小彩虹~写了很久的表白~求翻牌哦",
        "哈哈很喜欢看火箭少女的几个小女生表演和互动的样子，这就是青春啊，太养眼了",
        "每天都想问你为什么这么可爱，徐女士我的心都被你偷走了知道吗",
        "可爱满分徐梦洁！心都给你徐梦洁！",
        "感觉自己在和你一起成长啊小彩虹，我们一起加油吧",
        "今天也是仙女下凡般的徐会长",
        "怎么可以有这样一个人完完全全长在了我的审美中心，又甜又清新，我真的太爱你了小彩虹",
        "最美的就是你的双眼，最甜的就是你的笑颜",
        "今天也是挚爱徐梦洁的一天",
        "今日吸彩虹打卡",
        "徐会长什么时候能翻我私信的牌呀~",
        "想念你！以后也请多多营业！看到你就是晴天！",
        "你就负责美美的往前冲就好了，后面的路永远有我们",
        "我们小彩蛋永远是你最坚实的依靠，加油冲吧徐教练！",
        "我们还是不够努力，只让你11名出道，现在镜头和资源都只能靠边站，但今后的路我们一定会更加努力的，请一定要相信我们，对我们有信心",
        "你一定要开心，只有你开心我才会开心",
        "爱笑的女孩运气不会太差的。11位出道，幸运之神会一直保护着你的，希望你未来的路也能一直顺顺利利幸幸运运！爱你彩虹！",
        "这个妹子笑起来我真是心都化了",
        "虽然你有时候的营业有、、尴尬（是真粉吗？？），但我就是喜欢这样真实的你，不需要太圆滑的互动和撩粉，就这样简单自然也挺好的",
        "哈喽哈喽嘿，请给你舞台@鹅厂",
        "小彩虹的美貌是真实的吗？？没有大红这是真实的吗？？徐梦洁你一定要给我红遍全国啊",
        "徐教练真的好可爱，麻麻心动了，母爱每天都在变质边缘",
        "给你笔芯！加油啊彩虹，看到出道以来每天都积极努力的你，想到我成天划水玩手机，惭愧了，今后也要向你一样努力才行",
        "与你相遇好幸运，成为你的粉丝好幸运",
        "这个夏天遇见你真像一场梦",
        "宝贝你一定要开心哦，我会一步一步陪你走下去的",
        "最近好像比较喜欢盐系的徐会长，哈哈，会长请多多盐系营业吧",
        "宝宝要不要考虑下多走走日系风格？喜欢日系清淡型的你",
        "不知道爱你在哪一天，不知道爱你在哪一点，不知道爱你从什么时候开始，但还是莫名其妙的好爱好爱你，徐梦洁请加油吧",
        "小彩虹要好好休息呀，不要太累了不要总熬夜，麻麻非常担心你滴身体呀",
        "喜欢过很多偶像，但都没有坚持太久，我可能天生不是个长情的人。但我敢保证的是，当下的我真的很喜欢很喜欢你",
        "(＾－＾)V人生的路自己走多孤单，有我陪着你，我们就一起走彩虹路吧",
        "彩虹一定会大红的，一定会的",
        "在下夜观天象，有仙子告诉老夫，这个名唤彩虹的女子未来一定会大红的",
        "甜甜的季节遇上甜甜的你",
        "我觉得你的肤色穿大红色一定特别好看，彩虹要不要多试试换换风格啊",
        "从土创这个节目一开始就关注你了，被你甜甜的笑容打败，没想到最后还真出道成功了，我还真是幸运啊",
        "我们不在意一时的热度，艺人一定要保证口碑，有实力有作品，才能长久的红下去。眼下我们人气和别人虽然有差距但却不是不可弥补的，相信未来我们一定会更好的",
        "喜欢徐会长还需要什么理由吗",
        "唉你为什么能这么可爱，多看几次你的微博我的工作又得废了",
        "治愈系女神~你的笑颜真的又清新又活泼，魂都要被你勾走了",
        "火箭少女11个人里最喜欢的就是你啦",
        "徐梦洁你为什么能这么好看！同时一直很想求求你贡献一下自拍的滤镜哈，造福造福我们粉丝嘛",
        "好久没追星了，徐鸡爪让我这颗死了的心又重燃爱火了",
        "上线营业的彩虹才是最美的彩虹（狗头）",
        "月落乌啼霜满天，等您更博要几天",
        "最近好无聊啊好无聊，只能靠翻你的微博看自拍来打发时间了",
        "小彩虹保佑我明天考试顺利吧",
        "我们妹妹最近有没有好好吃饭好好练习啊？期待下次看到你们的舞台哦",
        "妹妹的唱功不知道有没有进步哦？多跟队里的vocal小姐姐们取经吧我是真的很想看到你们在舞台上完美的表现啊",
        "还好101有你，还好我为了打发时间去看了101，成为你的粉丝太让我幸福了",
        "我好想你特别想你超级想你，每天都想来跟你表白，我是不是快疯了",
        "小天使小可爱徐梦洁~",
        "我其实最喜欢温温柔柔软软糯糯的你，哈哈哈，想多多看到这样的你",
        "纵横饭圈20年被甜到在你这里，我真的中了徐梦洁的毒",
        "想看你拍戏！我们徐会长这样的脸不演几个校园偶像剧女主角实在是太可惜了，想看你演袁湘琴~",
        "来看看你的微博才有心情去学习！",
        "睡前再来看看小彩虹的微博，我要做一个甜甜甜甜甜的梦",
        "好想拥有你这样乖巧甜美的女儿哦",
        "最近天气变得很差，但是看到你的心情和对你的爱意是不会变的",
        "最近真的很多难过的事发生，一直在看关于你的视频才能勉强疗伤。谢谢你小彩虹",
        "徐梦洁真的太可爱太犯规了，看了一次你的直拍之后就在也出不去了",
        "徐会长您好，我是您忠诚的彩蛋、彩虹雨、洗洁精！以后也请多多营业多多更博哦",
        "不好意思说但我其实真的是被你家烧烤圈粉的哈哈哈哈，哦不对，是油炸~",
        "有生之年好想去吃一次根建啊，彩虹红了以后挣大钱给爸爸开分店吧？这么优秀的店子一定会火遍全国的",
        "茫茫人海中你一定不知道有我这么爱着你吧，可爱的小彩虹",
        "是我的好宝贝，美好的让人无法自拔，今天又是沉迷徐梦洁美颜的一天",
        "水蜜桃女孩，夏日甜心。看到你就觉得非常清新",
        "人生啊，如梦啊，亲爱的你，在这里~",
        "好爱徐教练的手臂肌肉线条，腹肌也超酷的",
        "小彩蛋会和小彩虹一起努力一起冲的",
        "彩虹彩虹看过来~这里是一颗迷恋你很久的小彩蛋~",
        "看到你心都化了，我们彩虹一定要越来越美越变越好啊！",
        "前几天去了根建，彩虹家的油炸实在太好吃了，吃了一顿想下顿。因为根建变得更爱你了呢",
        "有时会回想起节目播出的那段时光。虽然每天都要投票、都要为你能不能出道而担惊受怕，但那时对你的喜欢却是最炽烈的，现在出道了反而稍微变淡了一些。不过别担心，我一定一定会陪你走到最后的！",
        "此刻的你，青春洋溢，风华正茂，真正可以说是未来可期。看到你的笑容就觉得未来一定非常光明非常美好，我的心都被你牵动了，小可爱徐梦洁",
        "以后我们妹妹一定会好好走花路、走彩虹路的",
        "看不见你的笑我怎么睡得着啊，所以又来翻你的微博了",
        "徐老师的路人缘真不是盖的，今天跟好几个朋友提到你，发现大家都好喜欢你哦。路人缘有时候真是天生的，这样又甜又可爱的女生很容易让人心动吧",
        "遇见你是偶然，喜欢上你不是偶然，徐梦洁我宣布我和你锁了",
        "出走半生，仍是少年。看着你这么多年来的努力与追梦，现在还能保持一颗像当初一样纯净阳光的内心，岁月待你真是太美好了",
        "小彩虹小彩虹小宝贝小宝贝，今天也是为你心动的一天呢",
        "女鹅好希望你能天天都更博天天都营业哦",
        "早睡早起身体好，不要总是熬夜伤身啦小彩虹",
        "我喜欢看着台上闪闪亮亮发着光的你，还好你最后出道了，不然一定是娱乐圈的一大损失啊",
        "虽然不知道要说啥，但还是想来留言证明我的存在。徐梦洁我爱你！",
        "真好，从出道以来看着你一点一点地变得越来越好，不愧是要走彩虹路的人呐",
        "宝贝真的好希望你出一个自拍教程，头次遇到这么一个自拍清新脱俗可甜可盐可娇媚可妖艳的女明星，希望你每天都更新一种类型的自拍",
        "你的酒窝没有酒，我却醉的像条狗。不对你好像连酒窝也没有，我却被你甜进心里",
        "最开始是看了一张你的饭拍图对你有印象的，小手张开向大家挥舞着，笑眼弯弯，当时就觉得你好可爱好可爱啊一拳锤进心里。好想牵着你的小手手一起走",
        "想求一些彩虹衣服的同款，就算是以前简单朴素的T恤也被你穿的好可爱好特别，想试试你这样的穿衣风格",
        "徐女士我真的很喜欢你，我的爱心电波您接收到了吗",
        "以前去吃过一次根建，感觉蛮一般还挺贵的，认识你之后又去吃了一次哇立刻就觉得好好吃哦简直是人间美味，我果然是戴上了把倍的粉丝滤镜吧哈哈",
        "你值得被更多人喜欢，你值得被所有人喜欢",
        "因为喜欢你把土创又从头到尾看了一遍，努力在每个角落搜寻你的身影",
        "喜欢到深处大概就是这种感觉吧，无论你身边有多少人都还是第一眼就看到你，无论你站在多角落还是第一眼就能找到你。",
        "看一次你的自拍对你的爱就又加深了一层呢，麻麻对你的爱是不会变质滴",
        "被朋友安利了来看看这个小姑娘，真的很不错诶又甜又美还很正能量，入股了，希望以后能发展的越来越好哦",
        "昨天晚上又梦到你了，梦见我和你一起回武义，你亲自给我串藕饼，我俩一起吃烧烤，哈哈哈口水都流出来了然后我就醒了",
        "自从知道你的外号是烧烤千金之后就更喜欢你啦，家里开着油炸店本人却一点也不油腻呢，清新甜美的小可爱徐梦洁~",
        "你很棒，不需要管别人怎么看你，昂首挺胸按你自己的目标继续前进吧，本彩蛋一定会是你成功路上最坚实的后盾",
        "小彩虹小姐姐，就这样一直无忧无虑地笑下去吧，爱那个明朗阳光的你",
        "咪咪兔那场的舞蹈真的可以给我们彩虹封神了，没有大爆真的很可惜，希望未来火箭团能再多出几个令人惊艳的舞台吧，我太喜欢在台上闪闪发光耀眼的你了",
        "一切都恰到好处，你美的不可方物，在笑容里迷了路，徐梦洁又甜又酷@火箭少女101_徐梦洁",
        "盐甜兼备徐梦洁",
        "以梦为马气势如虹徐梦洁冲呀冲呀冲呀@火箭少女101_徐梦洁 @火箭少女101_徐梦洁 @火箭少女101_徐梦洁",
        "踩点狂魔徐梦洁，爱跳舞的小彩虹等你来pick啊 @火箭少女101_徐梦洁 @火箭少女101_徐梦洁 @火箭少女101_徐梦洁",
        "徐梦洁你太好看了吧！多发自拍好吗爱你爱你",
        "徐梦洁我来了啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊徐梦洁",
        "我们一天天在长大 在长高 在长肉肉 我也在一天天的更喜欢你吖❤@火箭少女101_徐梦洁",
        "总有一天彩虹雨会下满整个城市",
        "元气满满小彩虹，福气多多徐梦洁！徐梦洁！彩蛋爱你！@火箭少女101_徐梦洁",
        "远而望之，皎若太阳升朝霞；迫而察之，灼若芙蕖出渌波。",
        "魅力富人徐梦洁笑眼藏蜜徐梦洁遇见你整个世界都变得清朗了",
        "笑眼弯弯小彩虹，元气舞担徐梦洁！徐梦洁继续在舞台发光发热吧！@火箭少女101_徐梦洁",
        "我们一天天在长大 在长高 在长肉肉 我也在一天天的更喜欢你吖❤@火箭少女101_徐梦洁",
        "小太阳很忙，小云朵想吃糖，长颈鹿嫌脖子不够长，喜欢的你太难忘❤@火箭少女101_徐梦洁",
        "你的眼神再温柔些 月亮会融化 我也会❤@火箭少女101_徐梦洁",
        "徐梦洁年年得福##徐梦洁德芙送福大使##徐梦洁横冲直撞20岁##彩虹妹妹徐梦洁##徐梦洁跑步都那么甜#【徐梦洁  偶像剧】【徐梦洁 首金】【徐梦洁 跳舞】【徐梦洁 直拍】【徐梦洁 自拍】【徐梦洁 穿搭】【徐梦洁 私服】【徐梦洁 德芙】【徐梦洁 年年得福】@火箭少女101_徐梦洁 @火箭少女101_徐梦洁",
        "徐梦洁小朋友 你为什么总是笑得那么甜 甜进我的心窝里[心]@火箭少女101_徐梦洁",
        "徐梦洁是会发“光”的彩虹，偷偷点亮了被窝，也温暖了我的心窝。@火箭少女101_徐梦洁",
        "感谢青峰老师的词，让火少点燃了青春的《光》，让徐梦洁与我们在最好的时候相遇。@火箭少女101_徐梦洁",
        "【徐梦洁 素颜】【徐梦洁  偶像剧】【徐梦洁 笑容】【徐梦洁 跳舞】【徐梦洁 直拍】【徐梦洁 肌肉】【徐梦洁 自拍】【徐梦洁 穿搭】【徐梦洁 私服】【徐梦洁 短跑】【徐梦洁 同款】【徐梦洁 独舞】【徐梦洁暖心】 【徐梦洁甜】@火箭少女101_徐梦洁 @火箭少女101_徐梦洁 @火箭少女101_徐梦洁",
        "一切都恰到好处，你美的不可方物，在笑容里迷了路，徐梦洁又甜又酷@火箭少女101_徐梦洁",
        "怎么会有人有这样的侧脸曲线啊？她真不是米开朗基罗捏出来的吗",
        "楼里姐妹别猖狂 彩虹就在我身旁 可攻可妹啥都强 我要为她去暖床@火箭少女101_徐梦洁 ",
        "左一脚右一脚前一脚后一脚炫光彩虹踢走你",
        "彩虹的努力我们都看到了 要更优秀更坚强啊！徐梦洁最棒！",
        "西街春日永，辇道与天通。 御水横银汉，仙桥挂彩虹。",
        "世界上美好的东西不太多 雨后初晴悬于天际的七色彩虹 二十来岁笑起来要人命的你@火箭少女101_徐梦洁",
        "我是不是第一个来捧场的崽",
        "你走向我，我觉得一日不见如隔三秋；你朝我笑，我又觉得三秋未见不过一日。@火箭少女101_徐梦洁 ",
        "“上帝的珠宝掉落一地 所以我看见满天繁星和你的眼睛”​@火箭少女101_徐梦洁",
        "彩虹笑颜能迷倒万千️盛夏甜酒你值得拥有️徐梦洁加油！彩虹比心",
        "徐梦洁冲啊！️我最爱的最强的最棒的小彩虹️",
        "彩虹光波持续发射🏻请注意查收哟@火箭少女101_徐梦洁",
        "心都化了我的彩虹加油啊！@火箭少女101_徐梦洁",
        "哪里有彩虹告诉我能不能把我的愿望还给我看不见你的笑我怎么睡得着@火箭少女101_徐梦洁",
        "最美的是你的双眼 最甜不过你的笑颜徐梦洁加油！",
    ];
}