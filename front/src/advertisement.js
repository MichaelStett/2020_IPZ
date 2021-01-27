class Advertisement {
    constructor(
        name,
        id,
        description,
        more,
        image,
        link,
        tag,
    ) {
        this.name = name;
        this.id = id;
        this.description = description;
        this.more = more;
        this.image = image;
        this.link = link;
        this.tag = tag;
    }
}

const Tag = {
    COLD: 'COLD',
    HOT: 'HOT',
    RAIN: 'RAIN',
}

let more = "";

const advertisements = [
    new Advertisement('Advertisement1', 1, 'Smooth woven fabric with synthetic filling for lightweight warmth. Made with recycled polyester. Plastic bottles and textile waste are processed into plastic chips and melted into new fibres. This saves water and energy and reduces greenhouse-gas emissions!', more, "./img/ads/Jacket_Ad.png", null, Tag.COLD),
    new Advertisement('Advertisement2', 2, 'CONNY watering can is a trusted solution designed mainly for gardening activities. With a removable sieve. The large handle increases the comfort of use. Resistant to mechanical damage and UV-light. Available in 2 sizes – with capacity of 1.8 and 4.5 litre – and 4 colour options. ', more, "./img/ads/WateringCan_Ad.png", null, Tag.HOT),
    new Advertisement('Advertisement3', 3, 'Smooth woven fabric with synthetic filling for lightweight warmth. Made with recycled polyester. Plastic bottles and textile waste are processed into plastic chips and melted into new fibres. This saves water and energy and reduces greenhouse-gas emissions!', more, "./img/ads/Jacket_Ad.png", null, Tag.COLD),
    new Advertisement('Advertisement4', 4, 'Smooth woven fabric with synthetic filling for lightweight warmth. Made with recycled polyester. Plastic bottles and textile waste are processed into plastic chips and melted into new fibres. This saves water and energy and reduces greenhouse-gas emissions!', more, "./img/ads/Jacket_Ad.png", null, Tag.COLD),
    new Advertisement('Advertisement5', 5, 'This windproof, automatic opening recycled umbrella has a vented overlapping canopy, black rubber finished handle and carbon fibre ribs. 90 cm long. Canopy span 120 cm.', more, "./img/ads/Umbrella_Ad.png", null, Tag.RAIN),
    new Advertisement('Advertisement6', 6, 'This windproof, automatic opening recycled umbrella has a vented overlapping canopy, black rubber finished handle and carbon fibre ribs. 90 cm long. Canopy span 120 cm.', more, "./img/ads/Umbrella_Ad.png", null, Tag.RAIN),
    new Advertisement('Advertisement7', 7, 'Designed and crafted in Italy. Crystal-tempered sunglass lenses provide protection with distortion-free vision. With a brand character that can best be described as classy, exclusive, stylish, and unique, SUNNY continues to go beyond trends.', more, "./img/ads/Sunglasses_Ad.png", null, Tag.HOT),
    new Advertisement('Advertisement8', 8, 'Designed and crafted in Italy. Crystal-tempered sunglass lenses provide protection with distortion-free vision. With a brand character that can best be described as classy, exclusive, stylish, and unique, SUNNY continues to go beyond trends.', more, "./img/ads/Sunglasses_Ad.png", null, Tag.HOT),
    new Advertisement('Advertisement9', 9, 'This windproof, automatic opening recycled umbrella has a vented overlapping canopy, black rubber finished handle and carbon fibre ribs. 90 cm long. Canopy span 120 cm.', more, "./img/ads/Umbrella_Ad.png", null, Tag.RAIN),
    new Advertisement('Advertisement10', 10, 'This windproof, automatic opening recycled umbrella has a vented overlapping canopy, black rubber finished handle and carbon fibre ribs. 90 cm long. Canopy span 120 cm.', more, "./img/ads/Umbrella_Ad.png", null, Tag.RAIN),
];

function getTag(weather) {
    let tags = [];
    if (!weather) {
        return;
    }
    if (weather.main.temp <= 10) {
        tags.push(Tag.COLD);
    }
    if (weather.main.temp > 10) {
        tags.push(Tag.HOT);
    }
    if (weather.weather[0].main === "Drizzle" || weather.weather[0].main === "Rain") {
        tags.push(Tag.RAIN);
    }

    let randomIndex = Math.floor(Math.random() * tags.length);
    return tags[randomIndex];

}

function ad(tag) {
    let filtered = advertisements.filter((i) => {
        return i.tag === tag;
    });
    let randomIndex = Math.floor(Math.random() * filtered.length);
    return filtered[randomIndex];
}

function createAdvertisementHTML(advertisement) {
    let element = document.createElement("div");
    let elementInner = document.querySelector("#advertisementTemplate").content.cloneNode(true);
    element.append(elementInner);

    let image = element.querySelector(".advert-image");
    image.src = advertisement.image;

    let desc = element.querySelector(".desc");
    desc.innerText = advertisement.description;
    let title = element.querySelector(".title");
    title.innerText = advertisement.name;


    return element;
}

function displayAd(weather) {
    let adElements = document.querySelectorAll(".advertisement");
    adElements.forEach((i) => {
        if (i.children[0]) {
            i.children[0].remove();
        }
        i.append(createAdvertisementHTML(ad(getTag(weather))));
    })
}

