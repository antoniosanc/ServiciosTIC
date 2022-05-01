<style type="text/css">
  body {
  background: #f5f5f5;
  font-family: 'Libre Franklin', sans-serif;
}
.Grid {
  width: 50rem;
  margin: 5rem auto;
}
.Grid-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 2.5rem;
}
.Card {
  position: relative;
  flex: 0 1 15rem;
  background-color: #fff;
  padding-bottom: 5rem;
  transition: background-color 0.2s cubic-bezier(0.5, 0.3, 0.8, 0.06);
  color: #000;
}
.Card-thumb {
  position: relative;
  width: 15rem;
  height: 10rem;
  perspective-origin: 50% 0%;
  perspective: 600px;
  z-index: 1;
}
.Card-image,
.Card-shadow {
  position: absolute;
  display: block;
  width: 15rem;
  height: 10rem;
  transition: all 0.2s cubic-bezier(0.42, 0, 0.58, 1);
}
.Card-shadow {
  opacity: 0.8;
}
.Card-shadow:nth-child(1) {
  opacity: 0.6;
  background-color: #673ab7;
  transition: all 0.2s cubic-bezier(0.42, 0, 0.58, 1) 0.07s;
}
.Card-shadow:nth-child(2) {
  opacity: 0.7;
  background-color: #3f51b5;
  transition: all 0.2s cubic-bezier(0.42, 0, 0.58, 1) 0.05s;
}
.Card-shadow:nth-child(3) {
  background-color: #2196f3;
  transition: all 0.2s cubic-bezier(0.42, 0, 0.58, 1) 0.03s;
}
.Card-image {
  position: relative;
  background-size: auto 100%;
  background-position: center;
  background-repeat: no-repeat;
  background-color: #607d8b;
}
.Card-image::before {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background-color: #3f51b5;
  content: '';
  opacity: 0;
  transition: opacity 0.1s;
}
.Card-title,
.Card-explore {
  position: absolute;
  bottom: 0;
  display: flex;
  align-items: center;
  width: 100%;
  height: 5rem;
  text-align: center;
  transition: all 0.2s cubic-bezier(0.5, 0.3, 0.8, 0.06);
}
.Card-title span,
.Card-explore span {
  padding: 0.5rem;
  flex: 1 1 auto;
  text-align: center;
}
.Card-explore {
  opacity: 0;
  transform: translate(0, -1rem);
  font-size: 0.75rem;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: #673ab7;
}
.Card-button {
  position: absolute;
  left: 50%;
  top: 5rem;
  padding: 0.5rem 1rem;
  background-color: #fff;
  border-radius: 2rem;
  border: 2px solid #3f51b5;
  color: #fff;
  font-size: 0.75rem;
  font-weight: 600;
  transform: translate(-50%, 2rem);
  cursor: pointer;
  transition: all 0.2s;
  opacity: 0;
  outline: none;
  z-index: 4;
}
.Card:hover,
.Card--active {
  background-color: #f5f5f5;
  cursor: pointer;
}
.Card:hover .Card-thumb,
.Card--active .Card-thumb {
  z-index: 3;
}
.Card:hover .Card-title,
.Card--active .Card-title {
  opacity: 0;
}
.Card:hover .Card-explore,
.Card--active .Card-explore {
  opacity: 1;
  transform: translate(0, 1rem);
  transition: all 0.2s cubic-bezier(0.42, 0, 0.58, 1) 0.1s;
}
.Card:hover .Card-image,
.Card--active .Card-image {
  transform: scale(1.05) translate(0, -1rem) rotateX(25deg);
}
.Card:hover .Card-image::before,
.Card--active .Card-image::before {
  opacity: 0.4;
}
.Card:hover .Card-shadow:nth-child(3),
.Card--active .Card-shadow:nth-child(3) {
  transform: scale(1.02) translate(0, -0.3rem) rotateX(15deg);
}
.Card:hover .Card-shadow:nth-child(2),
.Card--active .Card-shadow:nth-child(2) {
  transform: scale(0.9) translate(0, 1rem) rotateX(15deg);
}
.Card:hover .Card-shadow:nth-child(1),
.Card--active .Card-shadow:nth-child(1) {
  transform: scale(0.82) translate(0, 2.4rem) rotateX(5deg);
}
.Card:hover .Card-button,
.Card--active .Card-button {
  opacity: 1;
  color: #3f51b5;
  transform: translate(-50%, 0);
}
.Card:hover .Card-button:hover,
.Card--active .Card-button:hover {
  color: #fff;
  background-color: #3f51b5;
}
.Card--active,
.Card--active:hover {
  background: none;
}
.Card--active .Card-explore,
.Card--active:hover .Card-explore {
  opacity: 0;
  transform: translate(0, 3rem);
  transition: all 0.5s cubic-bezier(0.42, 0, 0.58, 1);
}
.Card--active .Card-image,
.Card--active:hover .Card-image {
  opacity: 0;
  transition: all 0.4s cubic-bezier(0.42, 0, 0.58, 1);
  transform: scale(1.05) translate(0, -2.5rem) rotateX(50deg);
}
.Card--active .Card-image::before,
.Card--active:hover .Card-image::before {
  opacity: 0.4;
}
.Card--active .Card-button,
.Card--active:hover .Card-button {
  opacity: 0;
  transition: all 0.35s cubic-bezier(0.42, 0, 0.58, 1);
  transform: translate(-50%, -2rem) scale(1, 0.4);
}
.Grid-row:nth-child(1) .Card:nth-child(1).Card--active .Card-shadow:nth-child(3),
.Grid-row:nth-child(1) .Card:nth-child(1) .Card--active:hover .Card-shadow:nth-child(3) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1);
  transform: scale(1) translate(6%, 113%);
}
.Grid-row:nth-child(1) .Card:nth-child(1).Card--active .Card-shadow:nth-child(2),
.Grid-row:nth-child(1) .Card:nth-child(1) .Card--active:hover .Card-shadow:nth-child(2) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1) 0.1s;
  transform: scale(1) translate(6%, 223%);
}
.Grid-row:nth-child(1) .Card:nth-child(1).Card--active .Card-shadow:nth-child(1),
.Grid-row:nth-child(1) .Card:nth-child(1) .Card--active:hover .Card-shadow:nth-child(1) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1) 0.2s;
  transform: scale(2.1) translate(81%, 80%);
}
.Grid-row:nth-child(1) .Card:nth-child(2).Card--active .Card-shadow:nth-child(3),
.Grid-row:nth-child(1) .Card:nth-child(2) .Card--active:hover .Card-shadow:nth-child(3) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1);
  transform: scale(1) translate(-108%, 113%);
}
.Grid-row:nth-child(1) .Card:nth-child(2).Card--active .Card-shadow:nth-child(2),
.Grid-row:nth-child(1) .Card:nth-child(2) .Card--active:hover .Card-shadow:nth-child(2) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1) 0.1s;
  transform: scale(1) translate(-108%, 223%);
}
.Grid-row:nth-child(1) .Card:nth-child(2).Card--active .Card-shadow:nth-child(1),
.Grid-row:nth-child(1) .Card:nth-child(2) .Card--active:hover .Card-shadow:nth-child(1) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1) 0.2s;
  transform: scale(2.1) translate(26%, 80%);
}
.Grid-row:nth-child(1) .Card:nth-child(3).Card--active .Card-shadow:nth-child(3),
.Grid-row:nth-child(1) .Card:nth-child(3) .Card--active:hover .Card-shadow:nth-child(3) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1);
  transform: scale(1) translate(-222%, 113%);
}
.Grid-row:nth-child(1) .Card:nth-child(3).Card--active .Card-shadow:nth-child(2),
.Grid-row:nth-child(1) .Card:nth-child(3) .Card--active:hover .Card-shadow:nth-child(2) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1) 0.1s;
  transform: scale(1) translate(-222%, 223%);
}
.Grid-row:nth-child(1) .Card:nth-child(3).Card--active .Card-shadow:nth-child(1),
.Grid-row:nth-child(1) .Card:nth-child(3) .Card--active:hover .Card-shadow:nth-child(1) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1) 0.2s;
  transform: scale(2.1) translate(-29%, 80%);
}
.Grid-row:nth-child(2) .Card:nth-child(1).Card--active .Card-shadow:nth-child(3),
.Grid-row:nth-child(2) .Card:nth-child(1) .Card--active:hover .Card-shadow:nth-child(3) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1);
  transform: scale(1) translate(6%, -55%);
}
.Grid-row:nth-child(2) .Card:nth-child(1).Card--active .Card-shadow:nth-child(2),
.Grid-row:nth-child(2) .Card:nth-child(1) .Card--active:hover .Card-shadow:nth-child(2) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1) 0.1s;
  transform: scale(1) translate(6%, 55%);
}
.Grid-row:nth-child(2) .Card:nth-child(1).Card--active .Card-shadow:nth-child(1),
.Grid-row:nth-child(2) .Card:nth-child(1) .Card--active:hover .Card-shadow:nth-child(1) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1) 0.2s;
  transform: scale(2.1) translate(81%, 0%);
}
.Grid-row:nth-child(2) .Card:nth-child(2).Card--active .Card-shadow:nth-child(3),
.Grid-row:nth-child(2) .Card:nth-child(2) .Card--active:hover .Card-shadow:nth-child(3) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1);
  transform: scale(1) translate(-108%, -55%);
}
.Grid-row:nth-child(2) .Card:nth-child(2).Card--active .Card-shadow:nth-child(2),
.Grid-row:nth-child(2) .Card:nth-child(2) .Card--active:hover .Card-shadow:nth-child(2) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1) 0.1s;
  transform: scale(1) translate(-108%, 55%);
}
.Grid-row:nth-child(2) .Card:nth-child(2).Card--active .Card-shadow:nth-child(1),
.Grid-row:nth-child(2) .Card:nth-child(2) .Card--active:hover .Card-shadow:nth-child(1) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1) 0.2s;
  transform: scale(2.1) translate(26%, 0%);
}
.Grid-row:nth-child(2) .Card:nth-child(3).Card--active .Card-shadow:nth-child(3),
.Grid-row:nth-child(2) .Card:nth-child(3) .Card--active:hover .Card-shadow:nth-child(3) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1);
  transform: scale(1) translate(-222%, -55%);
}
.Grid-row:nth-child(2) .Card:nth-child(3).Card--active .Card-shadow:nth-child(2),
.Grid-row:nth-child(2) .Card:nth-child(3) .Card--active:hover .Card-shadow:nth-child(2) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1) 0.1s;
  transform: scale(1) translate(-222%, 55%);
}
.Grid-row:nth-child(2) .Card:nth-child(3).Card--active .Card-shadow:nth-child(1),
.Grid-row:nth-child(2) .Card:nth-child(3) .Card--active:hover .Card-shadow:nth-child(1) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1) 0.2s;
  transform: scale(2.1) translate(-29%, 0%);
}
.Grid-row:nth-child(3) .Card:nth-child(1).Card--active .Card-shadow:nth-child(3),
.Grid-row:nth-child(3) .Card:nth-child(1) .Card--active:hover .Card-shadow:nth-child(3) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1);
  transform: scale(1) translate(6%, -223%);
}
.Grid-row:nth-child(3) .Card:nth-child(1).Card--active .Card-shadow:nth-child(2),
.Grid-row:nth-child(3) .Card:nth-child(1) .Card--active:hover .Card-shadow:nth-child(2) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1) 0.1s;
  transform: scale(1) translate(6%, -113%);
}
.Grid-row:nth-child(3) .Card:nth-child(1).Card--active .Card-shadow:nth-child(1),
.Grid-row:nth-child(3) .Card:nth-child(1) .Card--active:hover .Card-shadow:nth-child(1) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1) 0.2s;
  transform: scale(2.1) translate(81%, -80%);
}
.Grid-row:nth-child(3) .Card:nth-child(2).Card--active .Card-shadow:nth-child(3),
.Grid-row:nth-child(3) .Card:nth-child(2) .Card--active:hover .Card-shadow:nth-child(3) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1);
  transform: scale(1) translate(-108%, -223%);
}
.Grid-row:nth-child(3) .Card:nth-child(2).Card--active .Card-shadow:nth-child(2),
.Grid-row:nth-child(3) .Card:nth-child(2) .Card--active:hover .Card-shadow:nth-child(2) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1) 0.1s;
  transform: scale(1) translate(-108%, -113%);
}
.Grid-row:nth-child(3) .Card:nth-child(2).Card--active .Card-shadow:nth-child(1),
.Grid-row:nth-child(3) .Card:nth-child(2) .Card--active:hover .Card-shadow:nth-child(1) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1) 0.2s;
  transform: scale(2.1) translate(26%, -80%);
}
.Grid-row:nth-child(3) .Card:nth-child(3).Card--active .Card-shadow:nth-child(3),
.Grid-row:nth-child(3) .Card:nth-child(3) .Card--active:hover .Card-shadow:nth-child(3) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1);
  transform: scale(1) translate(-222%, -223%);
}
.Grid-row:nth-child(3) .Card:nth-child(3).Card--active .Card-shadow:nth-child(2),
.Grid-row:nth-child(3) .Card:nth-child(3) .Card--active:hover .Card-shadow:nth-child(2) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1) 0.1s;
  transform: scale(1) translate(-222%, -113%);
}
.Grid-row:nth-child(3) .Card:nth-child(3).Card--active .Card-shadow:nth-child(1),
.Grid-row:nth-child(3) .Card:nth-child(3) .Card--active:hover .Card-shadow:nth-child(1) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1) 0.2s;
  transform: scale(2.1) translate(-29%, -80%);
}
.Gallery {
  display: block;
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background: #f5f5f5;
  opacity: 0;
  transform: scale(1.2);
  transition: none;
  padding: 18rem 0;
  overflow-y: scroll;
}
.Gallery-header {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  background-color: #eee;
  padding-bottom: 5rem;
}
.Gallery-close {
  position: absolute;
  right: 1rem;
  top: 1rem;
  font-size: 3rem;
  opacity: 0.5;
  cursor: pointer;
}
.Gallery-close:hover {
  opacity: 0.8;
}
.Gallery-images {
  display: flex;
  width: 47rem;
  margin: 0 auto;
  justify-content: space-between;
  margin-bottom: 1rem;
}
.Gallery-images:nth-child(3) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1) 0.33s;
  opacity: 0;
  transform: translate(0, 3rem) scale(1.1);
}
.Gallery-images:nth-child(4) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1) 0.44s;
  opacity: 0;
  transform: translate(0, 3rem) scale(1.1);
}
.Gallery-images:nth-child(5) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1) 0.55s;
  opacity: 0;
  transform: translate(0, 3rem) scale(1.1);
}
.Gallery-images:nth-child(6) {
  transition: all 0.2s cubic-bezier(0.7, 0, 0.78, 1) 0.66s;
  opacity: 0;
  transform: translate(0, 3rem) scale(1.1);
}
.Gallery-left {
  flex: 1 auto;
  display: flex;
  justify-content: space-between;
  flex-direction: column;
}
.Gallery-image {
  display: block;
  width: 15rem;
  height: 9.5rem;
  transition: all 0.2s cubic-bezier(0.42, 0, 0.58, 1);
  background: #aebfc7;
  background-size: auto 100%;
  background-position: center;
  background-repeat: no-repeat;
}
.Gallery-image--primary {
  width: 31rem;
  height: 20rem;
  background-color: #673ab7;
}
.Gallery--active {
  z-index: 100;
  background: #fff;
  transform: scale(1);
  opacity: 1;
  transition: all 0.5s cubic-bezier(0.7, 0, 0.78, 1) 0.1s;
}
.Gallery--active .Gallery-close {
  display: block;
}
.Gallery--active .Gallery-images {
  opacity: 1;
  transform: none;
}
</style>
<section class="Grid">
  <div class="Grid-row"><a class="Card" onClick="openGallery(1)" id="card-1">
      <div class="Card-thumb">
        <div class="Card-shadow"></div>
        <div class="Card-shadow"></div>
        <div class="Card-shadow"></div>
        <div class="Card-image" style="background-image: url(https://robohash.org/1)"></div>
      </div>
      <div class="Card-title"><span>Super interesting card</span></div>
      <div class="Card-explore"><span>Explore 50 more</span></div>
      <button class="Card-button">view more</button></a><a class="Card" onClick="openGallery(2)" id="card-2">
      <div class="Card-thumb">
        <div class="Card-shadow"></div>
        <div class="Card-shadow"></div>
        <div class="Card-shadow"></div>
        <div class="Card-image" style="background-image: url(https://robohash.org/2)"></div>
      </div>
      <div class="Card-title"><span>Super interesting card</span></div>
      <div class="Card-explore"><span>Explore 50 more</span></div>
      <button class="Card-button">view more</button></a><a class="Card" onClick="openGallery(3)" id="card-3">
      <div class="Card-thumb">
        <div class="Card-shadow"></div>
        <div class="Card-shadow"></div>
        <div class="Card-shadow"></div>
        <div class="Card-image" style="background-image: url(https://robohash.org/3)"></div>
      </div>
      <div class="Card-title"><span>Super interesting card</span></div>
      <div class="Card-explore"><span>Explore 50 more</span></div>
      <button class="Card-button">view more</button></a>
  </div>
  <div class="Grid-row"><a class="Card" onClick="openGallery(4)" id="card-4">
      <div class="Card-thumb">
        <div class="Card-shadow"></div>
        <div class="Card-shadow"></div>
        <div class="Card-shadow"></div>
        <div class="Card-image" style="background-image: url(https://robohash.org/4)"></div>
      </div>
      <div class="Card-title"><span>Super interesting card</span></div>
      <div class="Card-explore"><span>Explore 50 more</span></div>
      <button class="Card-button">view more</button></a><a class="Card" onClick="openGallery(5)" id="card-5">
      <div class="Card-thumb">
        <div class="Card-shadow"></div>
        <div class="Card-shadow"></div>
        <div class="Card-shadow"></div>
        <div class="Card-image" style="background-image: url(https://robohash.org/5)"></div>
      </div>
      <div class="Card-title"><span>Super interesting card</span></div>
      <div class="Card-explore"><span>Explore 50 more</span></div>
      <button class="Card-button">view more</button></a><a class="Card" onClick="openGallery(6)" id="card-6">
      <div class="Card-thumb">
        <div class="Card-shadow"></div>
        <div class="Card-shadow"></div>
        <div class="Card-shadow"></div>
        <div class="Card-image" style="background-image: url(https://robohash.org/6)"></div>
      </div>
      <div class="Card-title"><span>Super interesting card</span></div>
      <div class="Card-explore"><span>Explore 50 more</span></div>
      <button class="Card-button">view more</button></a>
  </div>
  <div class="Grid-row"><a class="Card" onClick="openGallery(7)" id="card-7">
      <div class="Card-thumb">
        <div class="Card-shadow"></div>
        <div class="Card-shadow"></div>
        <div class="Card-shadow"></div>
        <div class="Card-image" style="background-image: url(https://robohash.org/7)"></div>
      </div>
      <div class="Card-title"><span>Super interesting card</span></div>
      <div class="Card-explore"><span>Explore 50 more</span></div>
      <button class="Card-button">view more</button></a><a class="Card" onClick="openGallery(8)" id="card-8">
      <div class="Card-thumb">
        <div class="Card-shadow"></div>
        <div class="Card-shadow"></div>
        <div class="Card-shadow"></div>
        <div class="Card-image" style="background-image: url(https://robohash.org/8)"></div>
      </div>
      <div class="Card-title"><span>Super interesting card</span></div>
      <div class="Card-explore"><span>Explore 50 more</span></div>
      <button class="Card-button">view more</button></a><a class="Card" onClick="openGallery(9)" id="card-9">
      <div class="Card-thumb">
        <div class="Card-shadow"></div>
        <div class="Card-shadow"></div>
        <div class="Card-shadow"></div>
        <div class="Card-image" style="background-image: url(https://robohash.org/9)"></div>
      </div>
      <div class="Card-title"><span>Super interesting card</span></div>
      <div class="Card-explore"><span>Explore 50 more</span></div>
      <button class="Card-button">view more</button></a>
  </div>
</section>
<section class="Gallery" id="gallery-1">
  <div class="Gallery-header"><a class="Gallery-close" onclick="closeAll()">×</a></div>
  <div class="Gallery-images">
    <div class="Gallery-left">
      <div class="Gallery-image"></div>
      <div class="Gallery-image"></div>
    </div>
    <div class="Gallery-image Gallery-image--primary" style="background-image: url(https://robohash.org/1)"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
</section>
<section class="Gallery" id="gallery-2">
  <div class="Gallery-header"><a class="Gallery-close" onclick="closeAll()">×</a></div>
  <div class="Gallery-images">
    <div class="Gallery-left">
      <div class="Gallery-image"></div>
      <div class="Gallery-image"></div>
    </div>
    <div class="Gallery-image Gallery-image--primary" style="background-image: url(https://robohash.org/2)"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
</section>
<section class="Gallery" id="gallery-3">
  <div class="Gallery-header"><a class="Gallery-close" onclick="closeAll()">×</a></div>
  <div class="Gallery-images">
    <div class="Gallery-left">
      <div class="Gallery-image"></div>
      <div class="Gallery-image"></div>
    </div>
    <div class="Gallery-image Gallery-image--primary" style="background-image: url(https://robohash.org/3)"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
</section>
<section class="Gallery" id="gallery-4">
  <div class="Gallery-header"><a class="Gallery-close" onclick="closeAll()">×</a></div>
  <div class="Gallery-images">
    <div class="Gallery-left">
      <div class="Gallery-image"></div>
      <div class="Gallery-image"></div>
    </div>
    <div class="Gallery-image Gallery-image--primary" style="background-image: url(https://robohash.org/4)"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
</section>
<section class="Gallery" id="gallery-5">
  <div class="Gallery-header"><a class="Gallery-close" onclick="closeAll()">×</a></div>
  <div class="Gallery-images">
    <div class="Gallery-left">
      <div class="Gallery-image"></div>
      <div class="Gallery-image"></div>
    </div>
    <div class="Gallery-image Gallery-image--primary" style="background-image: url(https://robohash.org/5)"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
</section>
<section class="Gallery" id="gallery-6">
  <div class="Gallery-header"><a class="Gallery-close" onclick="closeAll()">×</a></div>
  <div class="Gallery-images">
    <div class="Gallery-left">
      <div class="Gallery-image"></div>
      <div class="Gallery-image"></div>
    </div>
    <div class="Gallery-image Gallery-image--primary" style="background-image: url(https://robohash.org/6)"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
</section>
<section class="Gallery" id="gallery-7">
  <div class="Gallery-header"><a class="Gallery-close" onclick="closeAll()">×</a></div>
  <div class="Gallery-images">
    <div class="Gallery-left">
      <div class="Gallery-image"></div>
      <div class="Gallery-image"></div>
    </div>
    <div class="Gallery-image Gallery-image--primary" style="background-image: url(https://robohash.org/7)"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
</section>
<section class="Gallery" id="gallery-8">
  <div class="Gallery-header"><a class="Gallery-close" onclick="closeAll()">×</a></div>
  <div class="Gallery-images">
    <div class="Gallery-left">
      <div class="Gallery-image"></div>
      <div class="Gallery-image"></div>
    </div>
    <div class="Gallery-image Gallery-image--primary" style="background-image: url(https://robohash.org/8)"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
</section>
<section class="Gallery" id="gallery-9">
  <div class="Gallery-header"><a class="Gallery-close" onclick="closeAll()">×</a></div>
  <div class="Gallery-images">
    <div class="Gallery-left">
      <div class="Gallery-image"></div>
      <div class="Gallery-image"></div>
    </div>
    <div class="Gallery-image Gallery-image--primary" style="background-image: url(https://robohash.org/9)"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
  <div class="Gallery-images">
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
    <div class="Gallery-image"></div>
  </div>
</section>