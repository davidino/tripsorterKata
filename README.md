# Trip sorter Kata


Build the container:

```sh
docker build -t davidino/tripsorter .
```

Run the container:

```sh
docker run davidino/tripsorter
```

the output :

```sh
 ./vendor/bin/phpspec run

      Davidino\TripSort\BoardingCard\TrainBoardingCard

  11  ✔ should return start and end points

      Davidino\TripSort\TripJourneyPrinter

  15  ✔ should print the journey
  33  ✔ should print the complete journey

      Davidino\TripSort\TripSorter

  14  ✔ should throw an exception when initialized without boarding card
  19  ✔ should handle one board card
  27  ✔ should sort adding on top
  36  ✔ should sort adding as last
  46  ✔ should be able to replace the first element
  56  ✔ should handle the card that is not yet connectable
  67  ✔ should handle the roundtrip
  77  ✔ should throw an exception when not all card are not connected
  89  ✔ should add a card
 102  ✔ should throw an error adding a card not connectable

      Davidino\TripSort\Trip

  11  ✔ should throw an exception when to and from are the same


4 specs
14 examples (14 passed)
17ms
 ```