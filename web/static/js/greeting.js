// JavaScript Document
class Greeter {
   constructor(greeting:string) { }
   greet() {
      return this.greeting;
   }
};
var greeter = new Greeter("Hello From TypeScript!");
console.log(greeter.greet()); 