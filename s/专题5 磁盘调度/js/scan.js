window.onload = function () {
    $(".showBtn").click(function () {
        let Track0 = Number.parseInt($(".Track0").val())
        let Track1 = Number($(".Track1").val())
        $(".track0").text(Track0)
        $(".track1").text(Track1)
        let Track = new Array()
        for (let i = 0; i < $(".Track").length; i++) {
            if ($(".Track").eq(i).val().length != 0) {
                thisTrack = Number.parseInt($(".Track").eq(i).val())
                Track[Track.length] = thisTrack
            }
        }
        let Tracks = new Array()
        let TrackObj = new Object()
        let TrackLength = Track.length
        // SCAN
        let dir = 1 // 1 减小方向 2 增加方向
        let nowTrack = Track1
        if (Track0 > Track1) {
            // 减小方向
            $(".TrackDri").text("(磁道号减小方向)")
            dir = 1
        } else {
            // 增大方向
            $(".TrackDri").text("(磁道号增大方向)")
            dir = 2
        }
        while (Tracks.length < TrackLength) {
            let findTrack = getTrack(Track, dir, nowTrack)
            if (!findTrack) {
                // 改变方向，做标记
                Tracks[Tracks.length - 1].flag = 1
                if (dir == 1) {
                    dir = 2
                } else if (dir == 2) {
                    dir = 1
                }
            } else {
                // 记录findTrack，原列表删除nowTrack，更新nowTrack
                TrackObj.value = findTrack
                TrackObj.flag = 0
                Tracks[Tracks.length] = JSON.parse(JSON.stringify(TrackObj))
                let index = Track.indexOf(findTrack)
                Track.splice(index, 1)
                nowTrack = findTrack
            }
        }
        // 展示第一问答案
        for (let i = 0; i < Tracks.length; i++) {
            $(".Tracks").append(Tracks[i].value + ",");
        }
        $(".Tracks").text($(".Tracks").text().slice(0, $(".Tracks").text().length - 1));
        // 计算ASL
        let SLTEval = ""
        nowTrack = Track1
        for (let i = 0; i < Tracks.length; i++) {
            if (Tracks[i].flag == 1) {
                if (nowTrack > Tracks[i].value) {
                    SLTEval += "+(" + nowTrack + "-" + Tracks[i].value + ")"
                } else {
                    SLTEval += "+(" + Tracks[i].value + "-" + nowTrack + ")"
                }
                nowTrack = Tracks[i].value
            }
        }
        if (nowTrack > Tracks[Tracks.length - 1].value) {
            SLTEval += "+(" + nowTrack + "-" + Tracks[Tracks.length - 1].value + ")"
        } else {
            SLTEval += "+(" + Tracks[Tracks.length - 1].value + "-" + nowTrack + ")"
        }
        SLTEval = SLTEval.substr(1)
        let SL = eval(SLTEval)
        let ASLB = TrackLength
        // 展示第二问答案
        $(".ASLT").text(SLTEval)
        $(".ASLB").text(ASLB)
        $(".ASLans").text(xiaoshu(SL / ASLB, 2))
    })

    function getTrack(Track, dir, nowTrack) {
        let TrackFlag = new Array()
        let minPositiveNumber = 999
        let minPositiveNumberIndex = 0
        let maxNegativeNumber = -999
        let maxNegativeNumberIndex = 0
        for (let i = 0; i < Track.length; i++) {
            TrackFlag[i] = Track[i] - nowTrack
            if (TrackFlag[i] > 0 && minPositiveNumber > TrackFlag[i]) {
                minPositiveNumber = TrackFlag[i]
                minPositiveNumberIndex = i
            } else if (TrackFlag[i] < 0 && maxNegativeNumber < TrackFlag[i]) {
                maxNegativeNumber = TrackFlag[i]
                maxNegativeNumberIndex = i
            }
        }
        if (dir == 1 && maxNegativeNumber != -999) {
            return Track[maxNegativeNumberIndex]
        } else if (dir == 2 && minPositiveNumber != 999) {
            return Track[minPositiveNumberIndex]
        } else {
            return false
        }
    }

    function xiaoshu(params, i) {
        let newpar = parseFloat(params);
        let reg = /^[0-9]+.?[0-9]*$/;
        if (reg.test(newpar)) {
            let newNum = newpar.toFixed(i);
            return newNum;
        }
    }
}