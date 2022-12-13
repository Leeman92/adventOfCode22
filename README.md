# Advent of Code 22

## Prequisites
* php 8 installed locally
  * I am developing with php8.2 but don't think I used any feature > 8.0
* make installed locally
* run `make setup`

## Folder Structure
* in `src/resources/input/xx/input.txt` can be your puzzle Input for the day
* in `src/resources/input/xx/test.input.txt` can be your test Input for the day
* to run the test you can do `php index.php --day=xx --test=true`
  * `01` to `31` are possible values for the days
  * `true` | `false` or `1` | `2` are possible values for --test (defaults to `false`)

## Example Output

```bash
user@machine:~/projects/adventofcode$ php index.php --day="02"
=========================================
The solution for day 02 part 1 is: 13052
=========================================
=========================================
The solution for day 02 part 2 is: 13693
=========================================
```