Destroysession

IF session not exist THEN
    Create yatzy object to session
ELSE
    Continue with game

IF POST next toss THEN
    Toss selected dice
    AND add one two "counter" variable
ELSE
    Toss all dices (only happens first time)

IF counter is 3 THEN
    CALL function to add score
    AND add 1 to round
    AND reset counter to 0

IF round is 7 THEN
    End game and show result
